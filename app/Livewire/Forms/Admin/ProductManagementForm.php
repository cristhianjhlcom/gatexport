<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductSpecifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class ProductManagementForm extends Form
{
    public ?Product $product = null;

    public bool $isEditing = false;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $slug = '';

    #[Validate]
    public ?string $description = null;

    #[Validate]
    public ?string $seo_title = null;

    #[Validate]
    public ?string $seo_description = null;

    #[Validate]
    public ProductStatusEnum $status = ProductStatusEnum::DRAFT;

    #[Validate]
    public ?int $selectedCategoryId = null;

    #[Validate]
    public ?int $selectedSubcategoryId = null;

    #[Validate]
    public $images = null;

    public array $specifications = [];

    #[Validate]
    public string $specificationKey = '';

    #[Validate]
    public string $specificationValue = '';

    public $categories;

    public $subcategories;

    public int $specificationsCount = 0;

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('products', 'slug')->ignore($this->product?->id),
            ],
            'description' => 'nullable|string|max:1000',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'status' => 'required',
            'selectedCategoryId' => 'required|exists:categories,id',
            'selectedSubcategoryId' => 'required|exists:subcategories,id',
            'images' => 'array|min:1|max:4',
            'images.*' => 'image|max:4500|dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000',
            /*
            'specifications' => 'array|max:5',
            'specifications.*.key' => 'required|string|max:50',
            'specifications.*.value' => 'required|string|max:255',
            */
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'selectedCategoryId.required' => __('Should select a category'),
            'selectedCategoryId.exists' => __('Category does not exist'),
            'selectedSubcategoryId.required' => __('Should select a subcategory'),
            'selectedSubcategoryId.exists' => __('Subcategory does not exist'),
            'images.*.max' => __('Each image must not exceed 4.5MB'),
            'images.*.dimensions' => __('Images must be 1000x1000 pixels'),
            /*
            'specifications.*.key.required' => __('Specification key is required'),
            'specifications.*.value.required' => __('Specification value is required'),
            */
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->seo_title = $product->seo_title;
        $this->seo_description = $product->seo_description;
        $this->status = $product->status;
        $this->selectedCategoryId = $product->subcategory->category->id;
        $this->selectedSubcategoryId = $product->subcategory_id;
        $this->images = $product->images;
        $this->specifications = $product->specifications->toArray();
        $this->specificationsCount = count($this->specifications);
        $this->product = $product;
    }

    public function addSpecification()
    {
        if (count($this->specifications) >= 5) {
            return;
        }

        $this->specifications[] = [
            'id' => count($this->specifications) + 1,
            'key' => str(mb_trim($this->specificationKey ?? ''))->title(),
            'value' => str(mb_trim($this->specificationValue ?? ''))->title(),
        ];

        $this->specificationKey = '';
        $this->specificationValue = '';
    }

    public function removeSpecification(int $idx): void
    {
        unset($this->specifications[$idx]);

        $this->specifications = array_values($this->specifications);
        $this->specificationsCount--;
    }

    public function updatedName(): void
    {
        $this->slug = str()->slug($this->name);
    }

    public function store(): Product
    {
        $this->validate();

        return DB::transaction(function () {
            $product = Product::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'status' => $this->status,
                'subcategory_id' => $this->selectedSubcategoryId,
            ]);

            // NOTE: Add images to the product.
            foreach ($this->images as $idx => $image) {
                $filename = str()->uuid()->toString() . '.' . $image->extension();
                $uploadedImage = $image->storeAs(path: 'uploads/products', name: $filename);

                Log::info('Uploaded Image', [
                    'image' => $image,
                    'uploaded_image' => $uploadedImage,
                    'filename' => $filename,
                    'exists' => Storage::disk('public')->exists($uploadedImage),
                ]);

                ProductImages::create([
                    'product_id' => $product->id,
                    'filename' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'path' => $uploadedImage,
                    'mime_type' => Storage::disk('public')->mimeType($uploadedImage),
                    'size' => Storage::disk('public')->size($uploadedImage),
                    'width' => 1000,
                    'height' => 1000,
                    'order' => $idx + 1,
                ]);
            }

            // NOTE: Add specifications to the product.
            foreach ($this->specifications as $specification) {
                ProductSpecifications::create([
                    'product_id' => $product->id,
                    'key' => (string) $specification['key'],
                    'value' => (string) $specification['value'],
                ]);
            }

            return $product->fresh(['images', 'specifications']);
        });
    }

    public function update(): Product
    {
        $this->validate();

        return DB::transaction(function () {
            if ($this->product->images->count() > 0) {
                foreach ($this->product->images as $image) {
                    Storage::disk('public')->delete($image->path);

                    $image->delete();
                }
            }

            foreach ($this->images as $idx => $image) {
                $filename = str()->uuid()->toString() . '.' . $image->extension();
                $uploadedImage = $image->storeAs(path: 'uploads/products', name: $filename, options: 'public');

                ProductImages::create([
                    'product_id' => $this->product->id,
                    'filename' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'path' => $uploadedImage,
                    'mime_type' => Storage::disk('public')->mimeType($uploadedImage),
                    'size' => Storage::disk('public')->size($uploadedImage),
                    'width' => 1000,
                    'height' => 1000,
                    'order' => $idx + 1,
                ]);
            }

            $this->product->update([
                'name' => str()->title($this->name),
                'slug' => $this->slug,
                'description' => $this->description,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'status' => $this->status,
                'subcategory_id' => $this->selectedSubcategoryId,
            ]);

            // NOTE: Add specifications to the product.
            foreach ($this->specifications as $specification) {
                ProductSpecifications::create([
                    'product_id' => $this->product->id,
                    'key' => (string) $specification['key'],
                    'value' => (string) $specification['value'],
                ]);
            }

            return $this->product->fresh();
        });
    }

    public function loadCategories(): void
    {
        // TODO: Mejorar la logica de carga ya que no esta cargando ^
        // correctamente al momento de editar un producto.
        // Solo se deberia agregar categorias que tengan subcategorias al listado.
        $this->categories = Category::with('subcategories')->orderBy('name')->get();
        $this->subcategories = $this->categories->first()->subcategories;

        if ($this->isEditing) {
            $this->selectedSubcategoryId = $this->product->subcategory_id;
            $this->selectedCategoryId = $this->product->subcategory->category->id;
        } else {
            $this->selectedCategoryId = $this->categories->first()->id;
            $this->selectedSubcategoryId = null;
        }
    }
}
