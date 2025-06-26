<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

final class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(10)->create();
    }
}
