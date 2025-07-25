<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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

    public $categories;

    public $subcategories;

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
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'selectedCategoryId.required' => 'Debe seleccionar una categoría',
            'selectedCategoryId.exists' => 'La categoría no existe',
            'selectedSubcategoryId.required' => 'Debe seleccionar una subcategoría',
            'selectedSubcategoryId.exists' => 'La subcategoría no existe',
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
        $this->product = $product;
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

            return $product->fresh(['images', 'specifications']);
        });
    }

    public function update(): Product
    {
        $this->validate();

        return DB::transaction(function () {
            $this->product->update([
                'name' => str()->title($this->name),
                'slug' => $this->slug,
                'description' => $this->description,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'status' => $this->status,
                'subcategory_id' => $this->selectedSubcategoryId,
            ]);

            return $this->product->fresh(['images', 'specifications']);
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
