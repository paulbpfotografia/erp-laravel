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

    public function indexAll()
    {
        $orders = Order::all();
        return view('modulos.logistica.pedidos.logistica-todos', compact('orders'));
    }

    public function indexPendientes()
    {
        $orders = Order::where('status', 'pendiente')->get();
        return view('modulos.logistica.pedidos.logistica-pendientes', compact('orders'));
    }

    public function indexEnviados()
    {
        $orders = Order::where('status', 'enviado')->get();
        return view('modulos.logistica.pedidos.logistica-enviados', compact('orders'));
    }

    public function indexEntregados()
    {
        $orders = Order::where('status', 'entregado')->get();
        return view('modulos.logistica.pedidos.logistica-entregados', compact('orders'));
    }

    public function indexPreparados()
    {
        $orders = Order::where('status', 'preparado')->get();
        return view('modulos.logistica.pedidos.logistica-preparados', compact('orders'));
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
        return view('modulos.logistica.pedidos.logistica-pedidos', compact('order'));
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
