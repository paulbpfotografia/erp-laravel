<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
        $order->load([
            'customer',
            'products.category'
        ]);

        return view('modulos.logistica.pedidos.logistica-datos-pedidos', compact('order'));
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


    public function updatePreparacion(Request $request, Order $order)
    {
        // Obtener los productos preparados desde el formulario
        $productosPreparados = $request->input('productos_preparados', []);

        // Actualizamos el valor de 'prepared' solo para los productos marcados
        foreach ($order->products as $product) {
            // Si el producto está en el array de productos preparados (marcado en el formulario)
            if (in_array($product->id, $productosPreparados)) {
                // Solo actualizamos 'prepared' si estaba marcado como no preparado
                if ($product->pivot->prepared == 0) {
                    $order->products()->updateExistingPivot($product->id, [
                        'prepared' => true, // Marcar como preparado
                    ]);
                }
            }
        }

        // Recargamos los productos actualizados para asegurarnos de tener los datos más actualizados
        $order->load('products');

        // Verificamos si todos los productos del pedido están preparados
        $todosPreparados = $order->products->every(function ($product) {
            return (bool) $product->pivot->prepared;
        });

        // Si todos los productos están preparados, cambiamos el estado del pedido a 'preparado'
        if ($todosPreparados && $order->status !== 'preparado') {
            $order->status = 'preparado';
            $order->save();

            //Cargo las relaciones
            $order->load(['customer', 'carrier', 'products']);

            //Generamos y guardamos el albarán en PDF
            $pdf = Pdf::loadView('modulos.pedidos.documentos.albaran', compact('order'));
            $filename = 'albaranes/pedido_' . $order->id . '.pdf';
            Storage::disk('public')->put($filename, $pdf->output());
        }


        return redirect()->back()->with('success', 'Progreso de preparación actualizado correctamente.');
    }



    public function preparar(Order $order)
    {
        //Con load cargamos la relación de pedido con el producto y sus especificaciones.
        $order->load(['products.specs']);
        return view('modulos.logistica.pedidos.logistica-preparar', compact('order'));
    }




}
