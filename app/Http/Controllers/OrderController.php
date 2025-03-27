<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;


use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver pedidos');
        $orders = Order::all();
        $customers = Customer::all();
        $products = Product::with('stock')->get();
        $categories = Category::with('products.stock')->get();


        return view('modulos.pedidos.pedidos',compact('orders','customers', 'products', 'categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //COMO USAMOS MODAL PARA CREAR, NO HACE FALTA COMPLETARLA
    }

    /**
     * Store a newly created resource in storage.
     */




     public function store(Request $request)
     {
         $this->authorize('crear pedidos');

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
             // Calculamos el total
             $total = 0;
             foreach ($validatedProducts as $product) {
                 $total += $product['quantity'] * $product['unit_price'];
             }

             // Creamos el pedido
             $order = Order::create([
                 'customer_id' => $request->customer_id,
                 'status' => 'pendiente',
                 'order_date' => now(),
                 'total' => $total,
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
                     'unit_price' => $product['unit_price'],
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

        return view('modulos.pedidos.pedidos-editar',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('editar pedidos');

        //
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
