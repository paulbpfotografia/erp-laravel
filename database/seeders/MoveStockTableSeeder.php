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
        //Prueba
        DB::table('move_stock')->insert([
            ['product_id' => 1, 'move_type' => 'Salida', 'quantity' => 5, 'reason' => 'Venta', 'order_id' => 1, 'move_date' => now()],
            ['product_id' => 2, 'move_type' => 'Salida', 'quantity' => 2, 'reason' => 'Venta', 'order_id' => 2, 'move_date' => now()],
            ['product_id' => 3, 'move_type' => 'Salida', 'quantity' => 10, 'reason' => 'Venta', 'order_id' => 3, 'move_date' => now()],
        ]);
    }
}
