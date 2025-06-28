<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\DTOs\Admin\ProductManagementData;
use App\Models\Product;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Storage;

final class ProductManagementServices
{
    public function __construct(
        private DatabaseManager $db,
    ) {}

    public function create(ProductManagementData $data): Product
    {
        return $this->db->transaction(function () use ($data) {
            $product = Product::create([
                'name' => $data->name,
                'slug' => $data->slug,
                'description' => $data->description,
                'seo_title' => $data->seoTitle,
                'seo_description' => $data->seoDescription,
                'status' => $data->status,
                'category_id' => $data->categoryId,
                'subcategory_id' => $data->subcategoryId,
            ]);

            $this->handleImages($product, $data->images);
            $this->handleSpecifications($product, $data->specifications);

            return $product->fresh(['images', 'specifications']);
        });
    }

    public function update(Product $product, ProductManagementData $data): Product
    {
        return $this->db->transaction(function () use ($product, $data) {
            $product->update([
                'name' => $data->name,
                'slug' => $data->slug,
                'description' => $data->description,
                'seo_title' => $data->seoTitle,
                'seo_description' => $data->seoDescription,
                'status' => $data->status,
                'category_id' => $data->categoryId,
                'subcategory_id' => $data->subcategoryId,
            ]);

            if ($data->images) {
                $this->replaceImages($product, $data->images);
            }

            if ($data->specifications) {
                $this->replaceSpecifications($product, $data->specifications);
            }

            return $product->fresh(['images', 'specifications']);
        });
    }

    private function handleImages(Product $product, array $images): void
    {
        foreach ($images as $image) {
            $path = $image->store('products', 'public');
            $product->images()->create(['path' => $path]);
        }
    }

    private function handleSpecifications(Product $product, array $specifications): void
    {
        foreach ($specifications as $spec) {
            $product->specifications()->create([
                'key' => $spec['key'],
                'value' => $spec['value'],
            ]);
        }
    }

    private function replaceImages(Product $product, array $images): void
    {
        // Delete old images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->images()->delete();
        $this->handleImages($product, $images);
    }

    private function replaceSpecifications(Product $product, array $specifications): void
    {
        $product->specifications()->delete();
        $this->handleSpecifications($product, $specifications);
    }
}
