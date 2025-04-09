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
            ['name' => 'Sofas', 'description' => 'Variedad en los modelos de sofás.'],
            ['name' => 'Mesas', 'description' => 'Mesas lista para restauración'],
            ['name' => 'Colchones', 'description' => 'Variedas de colchones catalogados para cumplir con la normativa en hoteles'],
            ['name' => 'Sillas', 'description' => 'Sillas ergonómicas y de diseño moderno.'],
            ['name' => 'Estanterias', 'description' => 'Perfectas para la organización de espacios'],
            ['name' => 'Lamparas', 'description' => 'Catálogo de lamparas de iluminación para el canal HORECA'],
            ['name' => 'Espejos', 'description' => 'Descripción espejos.'],
            ['name' => 'Alfombras', 'description' => 'Diferentes estilos y materiales en alfombras.'],
            ['name' => 'Camas', 'description' => 'Soportes y otros para colchones'],
            ['name' => 'Muebles de TV', 'description' => 'Muebles de TV listas para todo tipo de espacios'],
        ]);
    }
}
