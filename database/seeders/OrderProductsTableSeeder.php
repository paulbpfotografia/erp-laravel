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
        //Prueba
        DB::table('order_products')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'unit_price' => 799.99], // Pedido 1 (Sofa)
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 2, 'unit_price' => 199.99], // Pedido 2 (Mesa)
            ['order_id' => 3, 'product_id' => 3, 'quantity' => 3, 'unit_price' => 449.99], // Pedido 3 (Colchon)
        ]);
    }
}
