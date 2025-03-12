<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos de Prueba
        DB::table('products')->insert([
            ['name' => 'Iny', 'description' => 'Nuevo modelo de sofa cama.', 'price' => 799.99, 'category_id' => 1], //Sofás
            ['name' => 'Artic', 'description' => 'Mesa confortable .', 'price' => 99.99, 'category_id' => 2], //Mesas
            ['name' => 'Apolo', 'description' => 'Comfort en nuestro modelo .', 'price' => 149.99, 'category_id' => 3], //Colchones
        ]);
    }
}
