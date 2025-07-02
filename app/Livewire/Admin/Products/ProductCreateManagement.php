<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatusEnum;
use App\Exceptions\Admin\ProductCreationException;
use App\Livewire\Forms\Admin\ProductManagementForm;
use App\Models\Category;
use App\Models\ProductSpecifications;
use App\Models\Subcategory;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
final class ProductCreateManagement extends Component
{
    use WithFileUploads;

    public ProductManagementForm $form;

    // private ProductManagementServices $services;

    public function mount()
    {
        // $this->services = app(ProductManagementServices::class);
        $this->form->loadCategories();
    }

    // NOTE: Se debe usar los events en el componente y no en el forms.
    #[\Livewire\Attributes\On('imageUploaded')]
    public function imageUploaded($image)
    {
        $this->form->images[] = $image;
        Log::info('Product current images', $this->form->images);
    }

    #[\Livewire\Attributes\On('imageRemoved')]
    public function imageRemoved($filename)
    {
        $this->form->images = array_filter($this->form->images, function ($img) use ($filename) {
            return $img['filename'] !== $filename;
        });
    }

    public function save()
    {
        // $this->authorize('create', Product::class);

        try {
            /*
            $productData = ProductManagementData::fromForm($this->form);
            $this->services->create($productData);
            */
            $this->form->store();
            $this->form->reset();

            Flux::toast(
                heading: __('Product Created'),
                text: __('Product has been created successfully.'),
                variant: 'success',
            );

            $this->redirect(route('admin.products.index'), navigate: true);
        } catch (ProductCreationException $exception) {
            report($exception);
            Flux::toast(
                heading: __('Something went wrong'),
                text: __('Error while saving product: ') . $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function updatedFormName(string $name)
    {
        $this->form->slug = str()->slug($name);
    }

    public function updatedFormSelectedCategoryId(string $categoryId)
    {
        $this->form->subcategories = Subcategory::where('category_id', $categoryId)->get();
        $this->form->selectedSubcategoryId = null;
    }

    public function addSpecification()
    {
        // $this->authorize('create', ProductSpecifications::class);
        $this->form->addSpecification();

        Flux::modal('add-specs')->close();
    }

    public function removeSpecification(int $idx)
    {
        $this->authorize('create', ProductSpecifications::class);
        $this->form->removeSpecification($idx);
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
