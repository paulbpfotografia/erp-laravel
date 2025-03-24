<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $customerIds = DB::table('customers')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        if (empty($productIds) || empty($customerIds)) {
            $this->command->warn('No hay productos o clientes disponibles para asociar a pedidos.');
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            // Generar una fecha entre septiembre 2024 y hoy
            $orderDate = Carbon::create(2024, 9, 1)->addDays(rand(0, now()->diffInDays('2024-09-01')));

            // Determinar el estado del pedido según la fecha
            $status = $orderDate < Carbon::create(2025, 2, 1) ? 'Entregado' : collect(['Preparado', 'Enviado', 'Pendiente', 'Recibido'])->random();

            // Crear el pedido
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => collect($customerIds)->random(),
                'order_date' => $orderDate,
                'status' => $status,
                'total' => 0, // se actualiza luego
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $total = 0;

            // Seleccionar productos aleatorios (1 a 5)
            $products = collect($productIds)->random(rand(1, 5));

            foreach ($products as $productId) {
                $quantity = rand(1, 10);
                $unitPrice = DB::table('products')->where('id', $productId)->value('price');
                $subtotal = $quantity * $unitPrice;
                $total += $subtotal;

                DB::table('order_product')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Actualizar el total en el pedido
            DB::table('orders')->where('id', $orderId)->update([
                'total' => round($total, 2),
            ]);
        }
    }
}
