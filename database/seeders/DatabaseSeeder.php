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
            SupplierSeeder::class,
            UsersTableSeeder::class,
            CustomerTableSeeder::class,
            CategoryTableSeeder::class,
            ProductsTableSeeder::class,
            StockTableSeeder::class,
            MoveStockTableSeeder::class,
            ProductDetailsTableSeeder::class,
            ProductSpecsTableSeeder::class,
            CarrierSeeder::class,
            OrdersTableSeeder::class,
            TodoListSeeder::class,

        ]);
    }
}
