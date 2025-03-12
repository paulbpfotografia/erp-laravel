<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos de prueba
        DB::table('category')->insert([
            ['name' => 'Sofás', 'description' => 'Variedad en los modelos de sofás.'],
            ['name' => 'Mesas', 'description' => 'Encontraras mesas de diferentes dimensiones cuadradas, redondas, etc.'],
            ['name' => 'Colchones', 'description' => 'Calidad y Confort en nuestros colchones.'],
        ]);
    }
}
