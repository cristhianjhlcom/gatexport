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
use Livewire\Attributes\Validate;
use Livewire\Form;

// NOTE: https://www.youtube.com/watch?v=pfSjRcudZVA
final class ProductManagementForm extends Form
{
    protected $listeners = ['imageUploaded', 'imageRemoved'];

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

    public $categories;

    public $subcategories;

    public array $images = [];

    public array $specifications = [];

    #[Validate]
    public string $specificationKey = '';

    #[Validate]
    public string $specificationValue = '';

    public int $specificationsCount = 0;

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|unique:products,slug',
            'description' => 'nullable|string|max:1000',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'status' => 'required',
            'selectedCategoryId' => 'required|exists:categories,id',
            'selectedSubcategoryId' => 'required|exists:subcategories,id',
            /*
            'uploadedImages' => 'array|min:1|max:4',
            'uploadedImages.*' => 'image|max:4500|dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000',
            'specifications' => 'array|max:5',
            'specifications.*.key' => 'required|string|max:50',
            'specifications.*.value' => 'required|string|max:255',
            */
        ];
    }

    public function messages(): array
    {
        return [
            'selectedCategoryId.required' => __('Should select a category'),
            'selectedCategoryId.exists' => __('Category does not exist'),
            'selectedSubcategoryId.required' => __('Should select a subcategory'),
            'selectedSubcategoryId.exists' => __('Subcategory does not exist'),
            /*
            'uploadedImages.*.max' => __('Each image must not exceed 4.5MB'),
            'uploadedImages.*.dimensions' => __('Images must be 1000x1000 pixels'),
            'specifications.*.key.required' => __('Specification key is required'),
            'specifications.*.value.required' => __('Specification value is required'),
            */
        ];
    }

    /*
    public function setProduct(Product $product): void
    {
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->seo_title = $product->seo_title;
        $this->seo_description = $product->seo_description;
        $this->status = $product->status;
        $this->selectedCategoryId = $product->category_id;
        $this->selectedSubcategoryId = $product->subcategory_id;
        $this->specifications = $product->specifications->toArray();
        $this->specificationsCount = count($this->specifications);
    }
    */

    public function addSpecification()
    {
        if (count($this->specifications) >= 5) {
            return;
        }

        $this->specifications[] = [
            'id' => count($this->specifications) + 1,
            'key' => str(trim($this->specificationKey ?? ''))->title(),
            'value' => str(trim($this->specificationValue ?? ''))->title(),
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

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            // TODO: Averiguar por que no funciona esto.
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
            foreach ($this->images as $image) {
                ProductImages::create([
                    'product_id' => $product->id,
                    'filename' => $image['filename'],
                    'original_name' => $image['originalName'],
                    'path' => $image['path'],
                    'mime_type' => $image['mimeType'],
                    'size' => $image['size'],
                    'width' => $image['width'],
                    'height' => $image['height'],
                    'order' => $image['order'],
                    'alt_text' => $image['altText'],
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

            $product->fresh(['images', 'specifications']);
        });
    }

    public function loadCategories(): void
    {
        $this->categories = Category::with('subcategories')->orderBy('name')->get();
        $this->subcategories = $this->categories->first()->subcategories;
        $this->selectedCategoryId = $this->categories->first()->id;
        $this->selectedSubcategoryId = null;
    }
}
