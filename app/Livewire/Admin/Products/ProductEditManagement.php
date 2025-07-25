<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatusEnum;
use App\Exceptions\Admin\ProductCreationException;
use App\Livewire\Forms\Admin\ProductManagementForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Edit Product')]
final class ProductEditManagement extends Component
{
    public ProductManagementForm $form;

    public function mount(Product $product)
    {
        $this->form->setProduct($product);
        $this->form->isEditing = true;
        $this->form->loadCategories();
    }

    public function save()
    {
        // $this->authorize('create', Product::class);
        try {
            $this->form->update();

            Flux::toast(
                heading: 'Producto Actualizado',
                text: 'El producto ha sido actualizado correctamente.',
                variant: 'success',
            );

            $this->redirect(route('admin.products.index'), navigate: true);
        } catch (ProductCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: 'Ups! Algo malo paso',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function updatedFormSelectedCategoryId(string $categoryId)
    {
        $this->form->subcategories = Subcategory::where('category_id', $categoryId)->get();
        $this->form->selectedSubcategoryId = null;
    }

    public function render()
    {
        $status = ProductStatusEnum::cases();
        $categories = Category::with('subcategories')->orderBy('name')->get();

        return view('livewire.admin.products.edit')->with([
            'status' => $status,
            'categories' => $categories,
        ]);
    }
}
