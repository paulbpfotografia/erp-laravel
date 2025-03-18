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
            ['name' => 'Mesas', 'description' => 'Encontrarás mesas de diferentes dimensiones cuadradas, redondas, etc.'],
            ['name' => 'Colchones', 'description' => 'Calidad y Confort en nuestros colchones.'],
            ['name' => 'Sillas', 'description' => 'Sillas ergonómicas y de diseño moderno.'],
            ['name' => 'Estanterías', 'description' => 'Organiza tus espacios con nuestras estanterías.'],
            ['name' => 'Lámparas', 'description' => 'Ilumina tu hogar con estilo.'],
            ['name' => 'Espejos', 'description' => 'Dale un toque elegante a tus espacios con nuestros espejos.'],
            ['name' => 'Alfombras', 'description' => 'Diferentes estilos y materiales en alfombras.'],
            ['name' => 'Camas', 'description' => 'Descansa plácidamente con nuestras camas.'],
            ['name' => 'Muebles de TV', 'description' => 'Optimiza tu sala con nuestros muebles para TV.'],
        ]);
    }
}
