<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $superAdminUser = User::role(RolesEnum::SUPER_ADMIN)->first();

        return [
            'id' => "ORD-{$this->faker->unique()->numberBetween(1000, 9999)}",
            'customer_firstname' => fake()->firstName(),
            'customer_lastname' => fake()->lastName(),
            'customer_email' => fake()->unique()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'notes' => fake()->paragraph(),
            'status' => fake()->randomElement(OrderStatusEnum::values()),
            'manager_id' => $superAdminUser->id,
            'total_products' => fake()->numberBetween(1, 4),
            'total_price' => fake()->numberBetween(1, 100),
        ];
    }
}
