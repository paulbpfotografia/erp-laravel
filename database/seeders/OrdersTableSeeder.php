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

        $pedidos = [];

        // Generar 200 pedidos desde septiembre 2024 a hoy
        $startDate = Carbon::create(2024, 9, 1);
        $daysRange = $startDate->diffInDays(now());

        for ($i = 0; $i < 200; $i++) {
            $orderDate = Carbon::create(2024, 9, 1)->addDays(rand(0, $daysRange));

            $status = $orderDate < Carbon::create(2025, 2, 1)
                ? 'entregado'
                : collect(['preparado', 'pendiente', 'enviado', 'entregado'])->random();

            $pedidos[] = [
                'order_date' => $orderDate,
                'status' => $status,
            ];
        }

        // Generar 100 pedidos desde febrero 2025 a hoy
        $startRecent = Carbon::create(2025, 2, 1);
        $recentRange = $startRecent->diffInDays(now());

        for ($i = 0; $i < 100; $i++) {
            $orderDate = Carbon::create(2025, 2, 1)->addDays(rand(0, $recentRange));

            $status = collect(['preparado', 'pendiente', 'enviado', 'entregado'])->random();

            $pedidos[] = [
                'order_date' => $orderDate,
                'status' => $status,
            ];
        }

        // Ordenar los pedidos por fecha ascendente
        usort($pedidos, fn($a, $b) => $a['order_date']->timestamp <=> $b['order_date']->timestamp);

        // Insertar pedidos en orden y generar sus productos
        foreach ($pedidos as $pedido) {
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => collect($customerIds)->random(),
                'order_date' => $pedido['order_date'],
                'status' => $pedido['status'],
                'total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $total = 0;

            $products = collect($productIds)->random(rand(1, 5));

            foreach ($products as $productId) {
                $quantity = rand(1, 10);
                $unitPrice = DB::table('products')->where('id', $productId)->value('price');
                $subtotal = $quantity * $unitPrice;
                $total += $subtotal;

                // Aquí es donde actualizamos el campo 'prepared' según el estado del pedido
                DB::table('order_product')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'prepared' => in_array($pedido['status'], ['entregado', 'enviado', 'preparado']), // Marcar como preparado si el pedido está en uno de esos estados
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('orders')->where('id', $orderId)->update([
                'total' => round($total, 2),
            ]);
        }
    }
}
