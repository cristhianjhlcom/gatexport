<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class SubcategoryManagementForm extends Form
{
    public ?Subcategory $subcategory = null;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $slug = '';

    #[Validate]
    public $image = null;

    #[Validate]
    public $category_id = null;

    public function messages(): array
    {
        return [
            'image.max' => __('Each image must not exceed 4.5MB'),
            'image.dimensions' => __('Images must be 1000x1000 pixels'),
        ];
    }

    public function setSubcategory(Subcategory $subcategory): void
    {
        $this->name = $subcategory->name;
        $this->slug = $subcategory->slug;
        $this->image = $subcategory->image;
        $this->category_id = $subcategory->category_id;
        $this->subcategory = $subcategory;
    }

    public function updatedName(): void
    {
        $this->slug = str()->slug($this->name);
    }

    public function store(): Subcategory
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'category_id' => $this->category_id,
        ];

        return DB::transaction(function () use ($data) {
            $path = $this->image->store(path: 'uploads/subcategories');

            $subcatetegory = Subcategory::create([
                'name' => str()->title($data['name']),
                'slug' => $data['slug'],
                'image' => $path,
                'category_id' => $data['category_id'],
            ]);

            Log::info('Sub Category Created', [
                'subcategory_id' => $subcatetegory->id,
                'subcategory_name' => $subcatetegory->name,
                'subcategory_slug' => $subcatetegory->slug,
                'subcategory_image' => $subcatetegory->image,
                'subcategory_category_id' => $subcatetegory->category_id,
            ]);

            return $subcatetegory->fresh();
        });
    }

    public function update(): Subcategory
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'category_id' => $this->category_id,
        ];

        return DB::transaction(function () use ($data) {
            if ($data['image'] && $data['image'] !== $this->subcategory->image) {
                if ($this->subcategory->image && Storage::disk('public')->exists($this->subcategory->image)) {
                    Storage::disk('public')->delete($this->subcategory->image);

                    Log::info('Sub Category Image Deleted', [
                        'image_path' => $this->subcategory->image,
                    ]);
                }

                $path = $data['image']->store(path: 'uploads/subcategories');
            } else {
                $path = $this->subcategory->image;
            }

            $this->subcategory->update([
                'name' => str()->title($data['name']),
                'slug' => $data['slug'],
                'image' => $path,
                'category_id' => $data['category_id'],
            ]);

            Log::info('Sub Category Updated', [
                'subcategory_id' => $this->subcategory->id,
                'subcategory_name' => $this->subcategory->name,
                'subcategory_slug' => $this->subcategory->slug,
                'subcategory_image' => $this->subcategory->image,
                'subcategory_category_id' => $this->subcategory->category_id,
            ]);

            return $this->subcategory->fresh();
        });
    }

    protected function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:3|max:90',
            'slug' => [
                'required',
                'string',
                Rule::unique('subcategories', 'slug')->ignore($this->subcategory?->id),
            ],
            'category_id' => 'required|exists:categories,id',
        ];

        if (! is_string($this->image)) {
            $rules['image'] = 'nullable|image|max:4500|dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000';
        }

        return $rules;
    }
}
