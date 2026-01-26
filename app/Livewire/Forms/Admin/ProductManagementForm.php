<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class ProductManagementForm extends Form
{
    public ?Product $product = null;

    public bool $isEditing = false;

    #[Validate]
    public $name = [
        'es' => '',
        'en' => '',
    ];

    #[Validate]
    public $slug = '';

    #[Validate]
    public $description = [
        'es' => null,
        'en' => null,
    ];

    #[Validate]
    public $seo = [
        'title' => [
            'es' => null,
            'en' => null,
        ],
        'description' => [
            'es' => null,
            'en' => null,
        ],
    ];

    #[Validate]
    public ProductStatusEnum $status = ProductStatusEnum::DRAFT;

    #[Validate]
    public ?int $position = 0;

    #[Validate]
    public ?int $selectedCategoryId = null;

    #[Validate]
    public ?int $selectedSubcategoryId = null;

    public $categories;

    public $subcategories;

    public function rules(): array
    {
        $rules = [
            'name.*' => 'required|string|min:3|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('products', 'slug')->ignore($this->product?->id),
            ],
            'description.*' => 'nullable|string|max:2000',
            'seo.title.*' => 'nullable|string|max:60',
            'seo.description.*' => 'nullable|string|max:160',
            'status' => 'required',
            'position' => 'nullable|integer|min:0',
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
            'selectedSubcategoryId.required' => 'Debe seleccionar una sub-categoría',
            'selectedSubcategoryId.exists' => 'La sub-categoría no existe',
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->seo = [
            'title' => $product->seo_title,
            'description' => $product->seo_title,
        ];
        $this->status = $product->status;
        $this->position = $product->position;
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
                'name' => [
                    'es' => str()->title($this->name['es']),
                    'en' => str()->title($this->name['en']),
                ],
                'slug' => $this->slug,
                'description' => $this->description,
                'seo_title' => [
                    'es' => str()->title($this->seo['title']['es']),
                    'en' => str()->title($this->seo['title']['en']),
                ],
                'seo_description' => $this->seo['description'],
                'status' => $this->status,
                'position' => $this->position ?? 0,
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
                'name' => [
                    'es' => str()->title($this->name['es']),
                    'en' => str()->title($this->name['en']),
                ],
                'slug' => $this->slug,
                'description' => $this->description,
                'seo_title' => [
                    'es' => str()->title($this->seo['title']['es']),
                    'en' => str()->title($this->seo['title']['en']),
                ],
                'seo_description' => $this->seo['description'],
                'status' => $this->status,
                'position' => $this->position ?? 0,
                'subcategory_id' => $this->selectedSubcategoryId,
            ]);

            return $this->product->fresh(['images', 'specifications']);
        });
    }

    public function loadCategories(): void
    {
        // TODO: Mejorar la lógica de carga ya que no esta cargando ^
        // correctamente al momento de editar un producto.
        // Solo se debería agregar categorías que tengan sub-categorías al listado

        if ($this->isEditing) {
            $this->categories = Category::with('subcategories')->orderBy('name')->get();
            $this->subcategories = Subcategory::where('category_id', $this->product->subcategory->category_id)->get();
            $this->selectedSubcategoryId = $this->product->subcategory->id;
            $this->selectedCategoryId = $this->product->subcategory->category->id;
        } else {
            $this->categories = Category::with('subcategories')->orderBy('name')->get();
            $this->subcategories = $this->categories->first()->subcategories;
            $this->selectedCategoryId = $this->categories->first()->id;
            $this->selectedSubcategoryId = $this->categories->first()->subcategories->first()->id;
        }
    }
}
