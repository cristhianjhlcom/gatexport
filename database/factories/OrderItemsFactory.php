<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItems>
 */
final class OrderItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->uuid(),
            'product_id' => fake()->uuid(),
            'quantity' => fake()->numberBetween(1, 4),
            'price' => fake()->numberBetween(1, 100),
            'subtotal_price' => fake()->numberBetween(1, 100),
        ];
    }
}
