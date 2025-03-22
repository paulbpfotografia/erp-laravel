<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;


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

        dd($request->all());

        foreach ($request->productos as $productoId) {
            
        }




        return redirect()->route('pedidos.index')
        ->with('message', 'Pedido realizado correctamente.')
        ->with('icono', 'success'); 
    
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
