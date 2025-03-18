<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoveStockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Datos de prueba
        $movimientos = [];

        // Obtener pedidos existentes
        $orders = DB::table('orders')->pluck('id')->toArray();
        $products = DB::table('products')->pluck('id')->toArray();

        foreach ($orders as $orderId) {
            $numProducts = rand(1, 5);
            for ($i = 0; $i < $numProducts; $i++) {
                $movimientos[] = [
                    'product_id' => $products[array_rand($products)],
                    'move_type' => 'Salida',
                    'quantity' => rand(1, 5),
                    'reason' => 'Venta',
                    'order_id' => $orderId,
                    'move_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 90) . ' days')),
                ];
            }
        }

        // Generar movimientos de entrada sin order_id
        for ($i = 0; $i < 50; $i++) {
            $movimientos[] = [
                'product_id' => $products[array_rand($products)],
                'move_type' => 'Entrada',
                'quantity' => rand(5, 20),
                'reason' => collect(['Reposición', 'Devolución', 'Nuevo stock'])->random(),
                'order_id' => null,
                'move_date' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 90) . ' days')),
            ];
        }

        DB::table('move_stock')->insert($movimientos);
    }
}
