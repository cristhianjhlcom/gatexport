<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProductStatusEnum;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subcategory = Subcategory::all();

        return [
            'name' => $name = fake()->sentence(3),
            'slug' => str()->slug($name),
            'status' => fake()->randomElement(array_values(ProductStatusEnum::cases())),
            'subcategory_id' => $subcategory->random()->id,
            'description' => fake()->paragraphs(3, true),
            'seo_title' => fake()->sentence(2),
            'seo_description' => fake()->paragraphs(1, true),
        ];
    }
}
