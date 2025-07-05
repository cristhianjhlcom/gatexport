<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subcategories;

use App\Exceptions\Admin\SubcategoryCreationException;
use App\Livewire\Forms\Admin\SubcategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Create Sub Category')]
final class SubcategoryCreateManagement extends Component
{
    use WithFileUploads;

    public SubcategoryManagementForm $form;

    public function save()
    {
        try {
            $this->form->store();

            Flux::toast(
                heading: __('Sub Category Created'),
                text: __('Sub Category has been created successfully.'),
                variant: 'success',
            );

            $this->form->reset();

            $this->redirect(route('admin.subcategories.index'), navigate: true);
        } catch (SubcategoryCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: __('Something went wrong'),
                text: __('Error while saving sub category: ') . $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function updatedFormName(string $name)
    {
        $this->form->slug = str()->slug($name);
    }

    public function render()
    {
        return view('livewire.admin.subcategories.create')->with([
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
