<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatusEnum;
use App\Livewire\Forms\Admin\ProductManagementForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Exception;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class ProductCreateManagement extends Component
{
    use WithFileUploads;

    public ProductManagementForm $form;

    public function mount()
    {
        $this->form->loadCategories();
    }

    public function save()
    {
        $this->authorize('create', Product::class);

        try {
            $product = $this->form->store();

            Flux::toast('El producto ha sido creado correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.products.edit', $product), navigate: true);
        } catch (Exception $exception) {
            report($exception);

            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function updatedFormNameEs(string $name)
    {
        $this->form->slug = str()->slug($name);
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

        return view('livewire.admin.products.create')
            ->with([
                'status' => $status,
                'categories' => $categories,
            ])
            ->title('Crear Producto | Administración');
    }
}
