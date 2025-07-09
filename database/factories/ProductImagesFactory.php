<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = str()->uuid()->toString() . '.jpg';
        $path = storage_path("app/public/uploads/products/{$filename}");

        $imageUrl = "https://placehold.net/600x600.png";
        file_put_contents($path, file_get_contents($imageUrl));

        $fileinfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime_type = $fileinfo->file($path);
        $filesize = filesize($path);

        $imagesize = getimagesize($path);
        $width = $imagesize[0];
        $height = $imagesize[1];

        return [
            'filename' => $filename,
            'original_name' => fake()->sentence(3) . '.' . '.jpg',
            'path' => "uploads/products/{$filename}",
            'mime_type' => $mime_type,
            'size' => $filesize,
            'width' => $width,
            'height' => $height,
            'order' => fake()->randomNumber([0, 4]),
        ];
    }
}
