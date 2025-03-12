<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos de prueba
        DB::table('clients')->insert([
            ['name' => 'John Doe', 'cif' => 'A12345678', 'address' => '123 Main St', 'phone' => '555-1234', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'cif' => 'B98765432', 'address' => '456 Oak Ave', 'phone' => '555-5678', 'email' => 'jane@example.com'],
            ['name' => 'Pedro Martinez', 'cif' => 'C11223344', 'address' => '789 Pine Rd', 'phone' => '555-9101', 'email' => 'pedro@example.com'],
        ]);
    }
}
