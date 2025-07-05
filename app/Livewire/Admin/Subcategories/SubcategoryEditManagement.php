<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subcategories;

use App\Exceptions\Admin\SubcategoryCreationException;
use App\Livewire\Forms\Admin\SubcategoryManagementForm;
use App\Models\Category;
use App\Models\Subcategory;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Edit Sub Category')]
final class SubcategoryEditManagement extends Component
{
    use WithFileUploads;

    public SubcategoryManagementForm $form;

    public function mount(Subcategory $subcategory)
    {
        $this->form->setSubcategory($subcategory);
    }

    public function save()
    {
        try {
            $this->form->update();

            Flux::toast(
                heading: __('Sub Category Updated'),
                text: __('Sub Category has been updated successfully.'),
                variant: 'success',
            );

            $this->form->reset();

            $this->redirect(route('admin.subcategories.index'), navigate: true);
        } catch (SubcategoryCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: __('Something went wrong'),
                text: __('Error while updating sub category: ').$exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.subcategories.edit')->with([
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
