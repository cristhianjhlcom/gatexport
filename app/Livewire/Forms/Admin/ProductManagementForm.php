<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Livewire\Form;

// NOTE: https://www.youtube.com/watch?v=pfSjRcudZVA
final class ProductManagementForm extends Form
{
    public string $name = '';

    public string $slug = '';

    public ?string $description = null;

    public ?string $seo_title = null;

    public ?string $seo_description = null;

    public ProductStatusEnum $status = ProductStatusEnum::DRAFT;

    public ?int $selectedCategoryId = null;

    public ?int $selectedSubcategoryId = null;

    public $categories;

    public $subcategories;

    public array $images = [];

    public array $specifications = [];

    public function __construct()
    {
        $this->categories = Category::with('subcategories')->orderBy('name')->get();
        $this->subcategories = $this->categories->first()->subcategories;
        $this->selectedCategoryId = $this->categories->first()->id;
        $this->selectedSubcategoryId = null;
    }

    public function create()
    {
        dd('save');
    }
}
