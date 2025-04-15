<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // LLamamos a todos los seeders para que se ejecuten de una
        $this->call([
            RolSeeder::class,
            UsersTableSeeder::class,
            CustomerTableSeeder::class, // Asegúrate de que este sea llamado primero
            CategoryTableSeeder::class,
            ProductsTableSeeder::class, // Asegúrate de que este sea llamado antes de Orders
            StockTableSeeder::class,
            MoveStockTableSeeder::class,
            ProductDetailsTableSeeder::class,
            ProductSpecsTableSeeder::class,
            CarrierSeeder::class, // Asegúrate de que este sea llamado antes de Orders
            OrdersTableSeeder::class,
        ]);
    }
}
