<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderLogisticsController extends Controller
{



    public function __construct()
    {
        $this->middleware('role:Logistica|Admin');
    }



    public function index()
    {
        //Devolvemos pedidos que no estén entregados.
        $orders = Order::where('status', '!=', 'entregado')->get();
        return view ('modulos.logistica.logistica', compact('orders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
