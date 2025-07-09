<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductSpecificationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // NOTE: Keys basados en productos de incienso.
        $keys = [
            'Color',
            'Tamaño',
            'Material',
            'Estado',
            'Tipo',
            'Marca',
            'Modelo',
            'Capacidad',
        ];

        return [
            'key' => fake()->randomElement($keys),
            'value' => fake()->sentence(2),
        ];
    }
}
