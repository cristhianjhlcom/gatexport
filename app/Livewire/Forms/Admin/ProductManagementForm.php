<?php

namespace App\Livewire\Forms\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Livewire\Form;


// NOTE: https://www.youtube.com/watch?v=pfSjRcudZVA
class ProductManagementForm extends Form
{
    public string $name = '';

    public string $slug = '';

    public ?string $description = NULL;

    public ?string $seo_title = NULL;

    public ?string $seo_description = NULL;

    public ProductStatusEnum $status = ProductStatusEnum::DRAFT;

    public ?int $selectedCategoryId = NULL;

    public ?int $selectedSubcategoryId = NULL;

    public $categories;

    public $subcategories;

    public array $images = [];

    public array $specifications = [];


    public function __construct()
    {
        $this->categories = Category::with('subcategories')->orderBy('name')->get();
        $this->subcategories = $this->categories->first()->subcategories;
        $this->selectedCategoryId = $this->categories->first()->id;
        $this->selectedSubcategoryId = NULL;
    }

    public function create()
    {
        dd('save');
    }
}
