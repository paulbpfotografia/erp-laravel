<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Prueba
        DB::table('stock')->insert([
            ['product_id' => 1, 'available_quantity' => 50],  // Producto 1 (Sofa)
            ['product_id' => 2, 'available_quantity' => 20],  // Producto 2 (Mesa)
            ['product_id' => 3, 'available_quantity' => 100], // Producto 3 (Colchon)
        ]);
    }
}
