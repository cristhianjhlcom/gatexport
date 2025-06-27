<?php

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatusEnum;
use App\Livewire\Forms\Admin\ProductManagementForm;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ProductCreateManagement extends Component
{
    public ProductManagementForm $form;

    public function save()
    {
        $this->form->create();
    }

    public function updatedFormSelectedCategoryId(string $categoryId)
    {
        $this->form->subcategories = Subcategory::where('category_id', $categoryId)->get();
        $this->form->selectedSubcategoryId = NULL;
    }

    public function render()
    {
        $status = ProductStatusEnum::cases();
        $categories = Category::with('subcategories')->orderBy('name')->get();
        // $subcategories = Subcategory::latest()->get();

        return view('livewire.admin.products.create')->with([
            'status' => $status,
            // 'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }
}
