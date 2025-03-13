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
        //Prueba
        DB::table('orders')->insert([
            ['costumer_id' => 1, 'order_date' => now(), 'status' => 'Preparado', 'total' => 799.99],
            ['costumer_id' => 2, 'order_date' => now(), 'status' => 'Enviado', 'total' => 199.99],
            ['costumer_id' => 3, 'order_date' => now(), 'status' => 'Pendiente', 'total' => 299.99],
        ]);
    }
}
