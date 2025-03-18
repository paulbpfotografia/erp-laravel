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
            ['product_id' => 1, 'available_quantity' => 50],  // Sofá
            ['product_id' => 2, 'available_quantity' => 20],  // Mesa
            ['product_id' => 3, 'available_quantity' => 100], // Colchón
            ['product_id' => 4, 'available_quantity' => 40],  // Silla
            ['product_id' => 5, 'available_quantity' => 30],  // Estantería
            ['product_id' => 6, 'available_quantity' => 60],  // Lámpara
            ['product_id' => 7, 'available_quantity' => 25],  // Espejo
            ['product_id' => 8, 'available_quantity' => 45],  // Alfombra
            ['product_id' => 9, 'available_quantity' => 35],  // Cama
            ['product_id' => 10, 'available_quantity' => 20], // Mueble TV
            ['product_id' => 11, 'available_quantity' => 50], // Sofá de cuero
            ['product_id' => 12, 'available_quantity' => 25], // Mesa extensible
            ['product_id' => 13, 'available_quantity' => 80], // Colchón viscoelástico
            ['product_id' => 14, 'available_quantity' => 45], // Silla acolchada
            ['product_id' => 15, 'available_quantity' => 30], // Estantería modular
            ['product_id' => 16, 'available_quantity' => 55], // Lámpara minimalista
            ['product_id' => 17, 'available_quantity' => 28], // Espejo con luz LED
            ['product_id' => 18, 'available_quantity' => 50], // Alfombra de lana
            ['product_id' => 19, 'available_quantity' => 40], // Cama individual
            ['product_id' => 20, 'available_quantity' => 22], // Mueble TV compartimentado
            ['product_id' => 21, 'available_quantity' => 60], // Sofá esquinero
            ['product_id' => 22, 'available_quantity' => 33], // Mesa de mármol
            ['product_id' => 23, 'available_quantity' => 90], // Colchón híbrido
            ['product_id' => 24, 'available_quantity' => 50], // Silla ergonómica
            ['product_id' => 25, 'available_quantity' => 37], // Estantería ajustable
            ['product_id' => 26, 'available_quantity' => 48], // Lámpara de pared
            ['product_id' => 27, 'available_quantity' => 29], // Espejo decorativo
            ['product_id' => 28, 'available_quantity' => 55], // Alfombra tejida
            ['product_id' => 29, 'available_quantity' => 42], // Cama King Size
            ['product_id' => 30, 'available_quantity' => 20], // Mueble TV rústico
        ]);
    }
}
