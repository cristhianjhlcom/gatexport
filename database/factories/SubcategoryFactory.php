<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
final class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = str()->uuid()->toString().'.jpg';
        $path = storage_path("app/public/uploads/subcategories/{$filename}");

        $imageUrl = 'https://placehold.net/600x600.png';
        file_put_contents($path, file_get_contents($imageUrl));

        return [
            'name' => $name = fake()->word(),
            'slug' => str()->slug($name),
            'image' => "uploads/subcategories/{$filename}",
        ];
    }
}
