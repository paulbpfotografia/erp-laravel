<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            ['costumer_id' => 1, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Preparado', 'total' => 799.99],
            ['costumer_id' => 2, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Enviado', 'total' => 199.99],
            ['costumer_id' => 3, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Pendiente', 'total' => 299.99],
            ['costumer_id' => 1, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Enviado', 'total' => 129.99],
            ['costumer_id' => 4, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Preparado', 'total' => 599.99],
            ['costumer_id' => 2, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Pendiente', 'total' => 349.99],
            ['costumer_id' => 5, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Enviado', 'total' => 999.99],
            ['costumer_id' => 6, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Preparado', 'total' => 159.99],
            ['costumer_id' => 3, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Enviado', 'total' => 449.99],
            ['costumer_id' => 7, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Pendiente', 'total' => 249.99],
            ['costumer_id' => 8, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Preparado', 'total' => 799.99],
            ['costumer_id' => 9, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Enviado', 'total' => 109.99],
            ['costumer_id' => 10, 'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')), 'status' => 'Pendiente', 'total' => 219.99],
        ]);

        // Generar más pedidos con clientes repetidos
        for ($i = 0; $i < 50; $i++) {
            DB::table('orders')->insert([
                'costumer_id' => rand(1, 20),
                'order_date' => date('Y-m-d', strtotime('-'.rand(1, 90).' days')),
                'status' => collect(['Preparado', 'Enviado', 'Pendiente'])->random(),
                'total' => rand(100, 1000) + (rand(0, 99) / 100),
            ]);
        }
    }
}
