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
        $carrierIds = DB::table('carriers')->pluck('id')->toArray();

        if (empty($productIds) || empty($customerIds) || empty($carrierIds)) {
            $this->command->warn('No hay productos, clientes o transportistas disponibles para asociar a pedidos.');
            return;
        }

        $pedidos = [];

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

        usort($pedidos, fn($a, $b) => $a['order_date']->timestamp <=> $b['order_date']->timestamp);

        foreach ($pedidos as $pedido) {
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => collect($customerIds)->random(),
                'order_date' => $pedido['order_date'],
                'status' => $pedido['status'],
                'carrier_id' => collect($carrierIds)->random(),
                'total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $total = 0;

            $products = collect($productIds)->random(rand(1, 5));

            foreach ($products as $productId) {
                $quantity = rand(1, 10);
                $product = DB::table('products')->where('id', $productId)->first();
                $specs = DB::table('product_specs')->where('product_id', $productId)->first();

                $groupPrice = $quantity * $product->price;
                $groupVolume = $specs ? $quantity * $specs->packaged_volume : 0;
                $groupWeight = $specs ? $quantity * $specs->weight : 0;

                $total += $groupPrice;

                DB::table('order_product')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'group_price' => $groupPrice,
                    'group_volume' => $groupVolume,
                    'group_weight' => $groupWeight,
                    'prepared' => in_array($pedido['status'], ['entregado', 'enviado', 'preparado']),
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
