<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            for ($idx = 0; $idx < $order->total_products; $idx++) {
                $product = Product::all()->random();

                OrderItems::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
