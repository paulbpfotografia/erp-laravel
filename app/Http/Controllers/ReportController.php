<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Order;

class ReportController extends Controller
{


    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);

        $totalOrders = Order::whereYear('order_date', $year)->count();
        $totalSales = Order::whereYear('order_date', $year)->sum('total');

        return view('modulos.informes.informes', compact('totalOrders', 'totalSales', 'year'));
    }




    public function ordersByMonth()
    {
        // Obtener los pedidos agrupados por mes y contar los pedidos
        $orders = DB::table('orders')
            ->selectRaw('YEAR(order_date) as year, MONTH(order_date) as month, COUNT(*) as count')
            ->groupBy(DB::raw('YEAR(order_date), MONTH(order_date)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Crear un array con los meses y la cantidad de pedidos
        $labels = [];
        $data = [];

        foreach ($orders as $order) {
            $labels[] = $this->getMonthName($order->month) . ' ' . $order->year; // Obtener el nombre del mes
            $data[] = $order->count; // Cantidad de pedidos
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    private function getMonthName($month)
    {
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        return $months[$month];
    }



    //Función para extraer las categorías más vendidas
    public function productsByCategory()
    {
        $categories = DB::table('order_product')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('category', 'products.category_id', '=', 'category.id')
            ->select('category.name', DB::raw('SUM(order_product.quantity) as total_sold'))
            ->groupBy('category.name')
            ->orderByDesc('total_sold')
            ->get();

        $labels = [];
        $data = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $data[] = $category->total_sold;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function topProducts()
    {
        $rows = DB::table('order_product')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                DB::raw('SUM(order_product.quantity) as total')
            )
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $labels = $rows->pluck('name')->toArray();
        $data   = $rows->pluck('total')->map(fn($t) => (int)$t)->toArray();

        return response()->json(compact('labels', 'data'));
    }

    public function orderStatusDistribution()
    {
        // Agrupo los pedidos por estado y cuento cuántos hay de cada uno
        $rows = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        // Preparo etiquetas (estados capitalizados) y datos (totales)
        $labels = $rows->pluck('status')
            ->map(fn($s) => ucfirst($s))
            ->toArray();

        $data   = $rows->pluck('total')
            ->map(fn($n) => (int)$n)
            ->toArray();

        return response()->json(compact('labels', 'data'));
    }
}
