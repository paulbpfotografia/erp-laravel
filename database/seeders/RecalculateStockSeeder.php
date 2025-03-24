<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecalculateStockSeeder extends Seeder
{
    public function run(): void
    {
        $products = DB::table('products')->pluck('id');

        foreach ($products as $productId) {
            $entradas = DB::table('move_stock')
                ->where('product_id', $productId)
                ->where('move_type', 'entrada')
                ->sum('quantity');

            $salidas = DB::table('move_stock')
                ->where('product_id', $productId)
                ->where('move_type', 'salida')
                ->sum('quantity');

            $disponible = $entradas - $salidas;

            DB::table('stock')->updateOrInsert(
                ['product_id' => $productId],
                [
                    'available_quantity' => $disponible,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $this->command->info('Stock actualizado correctamente a partir de los movimientos.');
    }
}
