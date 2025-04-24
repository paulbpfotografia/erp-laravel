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

         // Filtrar productos válidos
         $validatedProducts = [];
         foreach ($request->products as $product) {
             if (!empty($product['id']) && !empty($product['quantity']) && $product['quantity'] > 0) {
                 $validatedProducts[] = $product;
             }
         }

         if (count($validatedProducts) === 0) {
             return redirect()->back()
                 ->with('message', 'Debe seleccionar al menos un producto con cantidad válida.')
                 ->with('icono', 'error');
         }

         //Iniciamos una transacción en la base de datos. Si falla, acaba con un rollback
         DB::beginTransaction();

         try {
             // Calculamos los totales. Dinero, volumen y peso.
             $total = 0;
             $totalVolume = 0;
             $totalWeight = 0;

             foreach ($validatedProducts as $product) {
                 $producto = Product::with('specs')->find($product['id']);

                 $total += $product['quantity'] * $product['unit_price'];

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
                 'total_volume' => $totalVolume,
                 'total_weight' => $totalWeight
             ]);

             // Asociamos los productos. Y actualizaremos el stock
             foreach ($validatedProducts as $product) {
                 $productoBD = Product::find($product['id']);

                 //Si el stock del producto que estoy intentando pasar es menor que la cantidad que han pedido, hago un rollback.
                 //Además, hacemos la comprobación de si existe la relación de stock y además su hay stock disponible
                 if (!$productoBD->stock || $productoBD->stock->available_quantity < $product['quantity']) {
                    DB::rollBack();
                     return redirect()->back()
                     ->with('message', "No hay suficiente stock para el producto '{$productoBD->name}'. Disponibles: {$productoBD->stock->available_quantity}.")
                     ->with('icono', 'error');
                 }

                 //De otra forma, con attach relaciono los datos en la tabla pivot
                 $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'group_price' => $product['quantity'] * $product['unit_price'],
                    'group_volume' => $product['quantity'] * ($productoBD->specs->packaged_volume ?? 0),
                    'group_weight' => $product['quantity'] * ($productoBD->specs->weight ?? 0),
                    'prepared' => false,
                ]);
                 //Resto el stock y  guardo el dato
                 $productoBD->stock->available_quantity -= $product['quantity'];
                 $productoBD->stock->save();
             }

             //Si todo ha salido bien, se hace commit
             DB::commit();

             //Devuelvo la vista del pedido con mensaje de éxito
             return redirect()->route('pedidos.show', $order->id)
                 ->with('message', 'Pedido creado correctamente.')
                 ->with('icono', 'success');


        //Si hay algún fallo, devuelvo error.
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
    
        return view('modulos.pedidos.pedidos-editar', compact('order'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('editar pedidos');
    
        if (!in_array($order->status, ['pendiente', 'preparado'])) {
            return redirect()->route('pedidos.index')->with('error', 'No se puede editar un pedido que ya ha sido enviado.');
        }
    
        $request->validate([
            'fecha' => 'required|date',
            'status' => 'required|in:pendiente,preparado',
        ]);
    
        $order->update([
            'fecha' => $request->fecha,
            'status' => $request->status,
        ]);
    
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->authorize('eliminar pedidos');

        //
    }




}
