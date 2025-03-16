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
            CostumerTableSeeder::class,
            CategoryTableSeeder::class,
            ProductsTableSeeder::class,
            StockTableSeeder::class,
            OrdersTableSeeder::class,
            OrderProductsTableSeeder::class,
            MoveStockTableSeeder::class,
        ]);
    }
}
