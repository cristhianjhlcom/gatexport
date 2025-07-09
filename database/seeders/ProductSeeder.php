<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductSpecifications;
use Illuminate\Database\Seeder;

final class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(20)
            ->has(ProductImages::factory()->count(4), 'images')
            ->has(ProductSpecifications::factory()->count(random_int(3, 7)), 'specifications')
            ->create();
    }
}
