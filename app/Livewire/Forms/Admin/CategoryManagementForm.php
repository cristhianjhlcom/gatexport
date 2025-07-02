<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\DriverException;

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
        $rules = [
            'name' => 'required|string|min:3|max:90',
            'slug' => [
                'required',
                'string',
                Rule::unique('categories', 'slug')->ignore($this->category?->id),
            ],
        ];

        if (!is_string($this->image)) {
            $rules['image'] = 'nullable|image|max:4500|dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000';
        }

        return $rules;
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
        $this->category = $category;
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
            $path = $this->image->store(path: 'uploads/categories');

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

    public function update(): Category
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
        ];

        Log::info('Updating Category', [
            'data' => $data,
        ]);

        return DB::transaction(function () use ($data) {
            if ($data['image'] && $data['image'] !== $this->category->image) {
                if ($this->category->image && Storage::disk('public')->exists($this->category->image)) {
                    Storage::disk('public')->delete($this->category->image);

                    Log::info('Category Image Deleted', [
                        'image_path' => $this->category->image,
                    ]);
                }

                $path = $data['image']->store(path: 'uploads/categories');
            } else {
                $path = $this->category->image;
            }

            $this->category->update([
                'name' => str()->title($data['name']),
                'slug' => $data['slug'],
                'image' => $path,
            ]);

            Log::info('Category Services: Category Updated', [
                'category_id' => $this->category->id,
                'category_name' => $this->category->name,
                'category_slug' => $this->category->slug,
                'category_image' => $this->category->image,
            ]);

            return $this->category->fresh();
        });
    }

    protected function uploadImage()
    {
        try {
            $manager = new ImageManager(new Driver());

            $file = $this->image;
            $filename = str()->uuid()->toString() . '.' . $file->extension();
            $image = $manager->read($file->getPathname());
            $image->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $path = "uploads/categories/{$filename}";
            // $path = Storage::storeAs('uploads/categories', $filename, 'public');
            $image
                ->toWebp(80)
                ->save(Storage::disk('public')->path($path)); // 80 = calidad

            Log::info('Filed Uploaded', [
                'path' => $path,
                'filename' => $filename,
            ]);

            return $path;
        } catch (\Exception $exception) {
            Log::error('General Exception Uploading Category Image', [
                'exception' => $exception,
            ]);
        } catch (DriverException $exception) {
            Log::error('Driver Exception Uploading Category Image', [
                'exception' => $exception,
            ]);
        }
    }
}
