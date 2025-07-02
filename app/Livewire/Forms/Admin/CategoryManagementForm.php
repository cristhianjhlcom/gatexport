<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

final class CategoryManagementForm extends Form
{
    public ?Category $category = NULL;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $slug = '';

    #[Validate]
    public $image = NULL;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:90',
            'slug' => [
                'required',
                'string',
                Rule::unique('categories', 'slug')->ignore($this->category?->id),
            ],
            'image' => 'nullable|image|max:4500|dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000',
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => __('Each image must not exceed 4.5MB'),
            'image.dimensions' => __('Images must be 1000x1000 pixels'),
        ];
    }

    public function setCategory(Category $category): void
    {
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
    }

    public function updatedName(): void
    {
        $this->slug = str()->slug($this->name);
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
        ];

        return DB::transaction(function () use ($data) {
            // $finalPath = $this->moveImageToStorage($data);
            $path = $this->image->store('public/uploads/categories');

            $catetegory = Category::create([
                'name' => str()->title($data['name']),
                'slug' => $data['slug'],
                'image' => $path,
            ]);

            Log::info('Category Services: Category Created', [
                'category_id' => $catetegory->id,
                'category_name' => $catetegory->name,
                'category_slug' => $catetegory->slug,
                'category_image' => $catetegory->image,
            ]);

            return $catetegory->fresh();
        });
    }

    /*
    public function update(): Category
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
        ];

        Log::info('Storing Category', [
            'data' => $data,
        ]);

        return DB::transaction(function () use ($data) {
            $finalPath = $this->moveImageToStorage($data);

            $category = $this->category->update([
                'name' => str()->title($data['name']),
                'slug' => $data['slug'],
                'image' => $finalPath,
            ]);

            Log::info('Category Services: Category Updated', [
                'category_id' => $category->id,
                'category_name' => $category->name,
                'category_slug' => $category->slug,
                'category_image' => $category->image,
            ]);

            return $category->fresh();
        });
    }
        */

    private function moveImageToStorage(array $data): string
    {
        $filename = $data['image']['filename'];
        $tempPath = "uploads/tmp/{$filename}";
        $finalPath = "uploads/categories/{$filename}";

        Log::info('Attempting to Move File', [
            'tmp_path' => Storage::path($tempPath),
            'final_path' => Storage::path($finalPath),
        ]);

        Storage::disk('public')->move($tempPath, $finalPath);

        return $finalPath;
    }
}
