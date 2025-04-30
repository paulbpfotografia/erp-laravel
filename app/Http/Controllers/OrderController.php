<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Carrier;


use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver pedidos');

        $query = Order::with('customer');

        // Filtamos por estado
        if ($request->filled('estado')) {
            $query->where('status', $request->estado);
        }

        // Búsqueda por ID o nombre del cliente
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('customer_id', $buscar) // ID exacto del cliente. Si no es exacto no buscará
                  ->orWhereHas('customer', function ($q2) use ($buscar) {
                      $q2->where('name', 'like', "%$buscar%"); // Nombre parcial del cliente. Si ponemos hotel, devolverá muchos registros. Pero hay que afinar más la búsqeuda
                  });
            });
        }

        // Paginación con 50 por página y manteniendo los filtros activos
        $orders = $query->orderByDesc('order_date')
                        ->paginate(50)
                        ->withQueryString();

        return view('modulos.pedidos.pedidos', compact('orders'));
    }






    public function create()
    {
        $customers = Customer::all();
        $carriers = Carrier::all();
        $categories = Category::with('products')->get();

        return view('modulos.pedidos.pedidos-crear', compact('customers', 'carriers', 'categories'));
    }


    public function store(Request $request)
    {
        $this->authorize('crear pedidos');

        //Validamos que el id del cliente sea correcto y que se haya enviado el array
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
        ]);

        // Filtro productos válidos
        $validatedProducts = [];
        foreach ($request->products as $product) {
            if (!empty($product['id']) && !empty($product['quantity']) && $product['quantity'] > 0) {
                $validatedProducts[] = $product;
            }
        }

        if (count($validatedProducts) === 0) {
            return redirect()->back()
                ->with('message', 'Debes seleccionar al menos un producto con cantidad válida.')
                ->with('icono', 'error');
        }

        //Iniciamos una transacción en la base de datos. Si falla, acaba con un rollback
        DB::beginTransaction();

        try {
            // Calculamos los totales. Dinero, IVA, volumen y peso.
            $total = 0;
            $totalIVA = 0;
            $totalVolume = 0;
            $totalWeight = 0;

            foreach ($validatedProducts as $product) {
                $producto = Product::with('specs')->find($product['id']);

                $precioSinIVA = $product['quantity'] * $product['unit_price'];
                $ivaProducto = $precioSinIVA * ($producto->iva / 100);

                $total += $precioSinIVA;
                $totalIVA += $ivaProducto;

                if ($producto && $producto->specs) {
                    $totalVolume += $product['quantity'] * $producto->specs->packaged_volume;
                    $totalWeight += $product['quantity'] * $producto->specs->weight;
                }
            }

            // Creamos el pedido
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'status' => 'pendiente',
                'order_date' => now(),
                'total' => $total,
                'total_iva' => $totalIVA,
                'total_con_iva' => $total + $totalIVA,
                'total_volume' => $totalVolume,
                'total_weight' => $totalWeight
            ]);

            // Asociamos los productos. Y actualizamos el stock
            foreach ($validatedProducts as $product) {
                $productoBD = Product::find($product['id']);

                if (!$productoBD->stock || $productoBD->stock->available_quantity < $product['quantity']) {
                    DB::rollBack();
                    return redirect()->back()
                        ->with('message', "No hay suficiente stock para el producto '{$productoBD->name}'. Disponibles: {$productoBD->stock->available_quantity}.")
                        ->with('icono', 'error');
                }

                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'group_price' => $product['quantity'] * $product['unit_price'],
                    'group_volume' => $product['quantity'] * ($productoBD->specs->packaged_volume ?? 0),
                    'group_weight' => $product['quantity'] * ($productoBD->specs->weight ?? 0),
                    'prepared' => false,
                ]);

                $productoBD->stock->available_quantity -= $product['quantity'];
                $productoBD->stock->save();
            }

            DB::commit();

            return redirect()->route('pedidos.show', $order->id)
                ->with('message', 'Pedido creado correctamente.')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('message', 'Hubo un error al procesar el pedido.')
                ->with('icono', 'error');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorize('ver pedidos');


        return view('modulos.pedidos.pedidos-datos', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('editar pedidos');

        if (!in_array($order->status, ['pendiente', 'preparado'])) {
            return redirect()->route('pedidos.index')->with('error', 'No se puede editar un pedido que ya ha sido enviado.');
        }

        $categories = Category::with('products.stock')->get();
        $allProducts = Product::all();

        return view('modulos.pedidos.pedidos-editar', compact('order', 'allProducts', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, Order $order)
{
    $this->authorize('editar pedidos');

    // Solo se pueden editar pedidos si está en pendiente o preparado
    if (!in_array($order->status, ['pendiente', 'preparado'])) {
        return redirect()->route('pedidos.index')->with('error', 'No se puede editar un pedido que ya ha sido enviado.');
    }

    // Validamos que lleguen correctamente los arrays
    $request->validate([
        'productos' => 'array',
        'nuevos' => 'array',
    ]);

    // Se empieza una transacción
    DB::beginTransaction();

    try {
        // Iniciamos variables para recalcular los datos del pedido
        $total = 0;
        $totalIVA = 0;
        $totalVolume = 0;
        $totalWeight = 0;

        // Variable para saber si algún producto preparado ha cambiado
        $preparadoModificado = false;

        // Recorremos productos ya existentes en el pedido
        foreach ($request->input('productos', []) as $productId => $datos) {
            $producto = Product::with('specs', 'stock')->find($productId);
            $nuevaCantidad = (int) $datos['cantidad'];

            // Obtenemos cantidad anterior y si estaba preparado
            $pivotData = DB::table('order_product')
                ->where('order_id', $order->id)
                ->where('product_id', $productId)
                ->first();

            $cantidadAnterior = $pivotData->quantity ?? 0;
            $estabaPreparado = $pivotData->prepared ?? false;

            // Si se ha puesto a 0, lo elimino del pedido y devuelvo el stock
            if ($nuevaCantidad <= 0) {
                $producto->stock->available_quantity += $cantidadAnterior;
                $producto->stock->save();
                $order->products()->detach($productId);
                continue;
            }

            // Si se aumenta la cantidad, verifico que haya stock suficiente
            $diferencia = $nuevaCantidad - $cantidadAnterior;
            if ($diferencia > 0 && $producto->stock->available_quantity < $diferencia) {
                DB::rollBack();
                return redirect()->back()
                    ->with('message', "Stock insuficiente para '{$producto->name}'.")
                    ->with('icono', 'error');
            }

            // Si el producto estaba preparado y su cantidad ha cambiado, marco que debe volver a pendiente
            $prepared = $estabaPreparado && $cantidadAnterior !== $nuevaCantidad ? false : $estabaPreparado;
            if ($estabaPreparado && $prepared === false) {
                $preparadoModificado = true;
            }

            // Actualizamos los datos en la tabla pivote
            $order->products()->updateExistingPivot($productId, [
                'quantity' => $nuevaCantidad,
                'group_price' => $nuevaCantidad * $producto->price,
                'group_volume' => $nuevaCantidad * ($producto->specs->packaged_volume ?? 0),
                'group_weight' => $nuevaCantidad * ($producto->specs->weight ?? 0),
                'prepared' => $prepared,
            ]);

            // Actualizamos el stock
            $producto->stock->available_quantity -= $diferencia;
            $producto->stock->save();

            // Recogemos los datos de los totales del pedido
            $subtotal = $nuevaCantidad * $producto->price;
            $iva = $subtotal * ($producto->iva / 100);

            $total += $subtotal;
            $totalIVA += $iva;
            $totalVolume += $nuevaCantidad * ($producto->specs->packaged_volume ?? 0);
            $totalWeight += $nuevaCantidad * ($producto->specs->weight ?? 0);
        }

        // Recorremos los productos nuevos
        foreach ($request->input('nuevos', []) as $productId => $cantidad) {
            $cantidad = (int) $cantidad;
            if ($cantidad <= 0) continue;

            $producto = Product::with('specs', 'stock')->find($productId);

            // Verificamos stock
            if (!$producto->stock || $producto->stock->available_quantity < $cantidad) {
                DB::rollBack();
                return redirect()->back()
                    ->with('message', "No hay suficiente stock para el producto '{$producto->name}'.")
                    ->with('icono', 'error');
            }

            // Añadimos el nuevo producto a la tabla pivote
            $order->products()->attach($productId, [
                'quantity' => $cantidad,
                'group_price' => $cantidad * $producto->price,
                'group_volume' => $cantidad * ($producto->specs->packaged_volume ?? 0),
                'group_weight' => $cantidad * ($producto->specs->weight ?? 0),
                'prepared' => false,
            ]);

            // Actualizamos el stock
            $producto->stock->available_quantity -= $cantidad;
            $producto->stock->save();

            // Como se ha añadido algo nuevo, hay que marcarlo como modificado
            $preparadoModificado = true;

            // Sumamos al total del pedido
            $subtotal = $cantidad * $producto->price;
            $iva = $subtotal * ($producto->iva / 100);

            $total += $subtotal;
            $totalIVA += $iva;
            $totalVolume += $cantidad * ($producto->specs->packaged_volume ?? 0);
            $totalWeight += $cantidad * ($producto->specs->weight ?? 0);
        }

        // Si el pedido estaba preparado y algo preparado se ha modificado, se devuelve a pendiente
        if ($order->status === 'preparado' && $preparadoModificado) {
            $order->status = 'pendiente';
        }

        // Recalculamos el total con IVA
        $totalConIVA = $total + $totalIVA;

        // Actualizamos los datos del pedido una vez cambiados
        $order->update([
            'total' => $total,
            'total_iva' => $totalIVA,
            'total_con_iva' => $totalConIVA,
            'total_volume' => $totalVolume,
            'total_weight' => $totalWeight,
            'order_date' => now(),
            'status' => $order->status,
        ]);

        DB::commit();

        return redirect()->route('pedidos.show', $order->id)
            ->with('message', 'Pedido actualizado correctamente.')
            ->with('icono', 'success');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('message', 'Error: ' . $e->getMessage())
            ->with('icono', 'error');
    }
}





    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Order $order)
    // {
    //     $this->authorize('eliminar pedidos');

    //     //
    // }


    //MÉTODO PARA CANCELAR PEDIDOS
    public function cancelOrder(Order $order)
{
    $this->authorize('editar pedidos');

    // Solo se pueden cancelar pedidos pendientes o preparados. Porque si se han enviado, ya no. Para eso se debería hacer un método devolución.
    if (!in_array($order->status, ['pendiente', 'preparado'])) {
        return redirect()->route('pedidos.index')
            ->with('error', 'Solo se pueden cancelar pedidos pendientes o preparados.');
    }

    //Empezamos transacción
    DB::beginTransaction();

    try {
        foreach ($order->products as $product) {
            $stock = $product->stock;

            if ($stock) {
                $stock->available_quantity += $product->pivot->quantity;
                $stock->save();
            }
        }

        $order->update(['status' => 'cancelado']);

        DB::commit();

        return redirect()->route('pedidos.index')->with('success', 'Pedido cancelado correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('pedidos.index')
            ->with('error', 'Error al cancelar el pedido.');
    }
}





}
