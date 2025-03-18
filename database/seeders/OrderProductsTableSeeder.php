<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos de prueba
        DB::table('order_products')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'unit_price' => 799.99], // Pedido 1 (Sofá)
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 2, 'unit_price' => 199.99], // Pedido 2 (Mesa)
            ['order_id' => 3, 'product_id' => 3, 'quantity' => 3, 'unit_price' => 449.99], // Pedido 3 (Colchón)
        ]);

        // Generar más registros de manera aleatoria
        for ($i = 4; $i <= 100; $i++) {
            $order_id = rand(1, 50); // Referencia a pedidos existentes
            $num_products = rand(1, 5); // Un pedido puede contener de 1 a 5 productos

            for ($j = 0; $j < $num_products; $j++) {
                DB::table('order_products')->insert([
                    'order_id' => $order_id,
                    'product_id' => rand(1, 30), // Referencia a productos existentes
                    'quantity' => rand(1, 5), // Cantidad de cada producto en el pedido
                    'unit_price' => round(rand(50, 1500) + (rand(0, 99) / 100), 2), // Precio aleatorio entre 50 y 1500
                ]);
            }
        }
    }
}
