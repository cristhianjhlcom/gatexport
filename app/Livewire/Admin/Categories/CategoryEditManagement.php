<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Exceptions\Admin\CategoryCreationException;
use App\Livewire\Forms\Admin\CategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Edit Category')]
final class CategoryEditManagement extends Component
{
    use WithFileUploads;

    public ?Category $category = NULL;

    public CategoryManagementForm $form;

    public function mount()
    {
        if ($this->category) {
            $this->form->setCategory($this->category);
        }
    }

    public function save()
    {
        try {
            $this->form->update();

            Flux::toast(
                heading: __('Category Updated'),
                text: __('Category has been updated successfully.'),
                variant: 'success',
            );

            $this->form->reset();

            $this->redirect(route('admin.categories.index'), navigate: true);
        } catch (CategoryCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: __('Something went wrong'),
                text: __('Error while updating category: ') . $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    #[\Livewire\Attributes\On('imageUploaded')]
    public function imageUploaded($image)
    {
        $this->form->image = $image;
    }

    #[\Livewire\Attributes\On('imageRemoved')]
    public function imageRemoved($image)
    {
        Log::info('form state after image removed', [
            'name' => $this->form->name,
            'slug' => $this->form->slug,
            'image' => $this->form->image,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.categories.edit');
    }
}
