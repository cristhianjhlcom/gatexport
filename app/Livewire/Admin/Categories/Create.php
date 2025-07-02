<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Exceptions\Admin\CategoryCreationException;
use App\Livewire\Forms\Admin\CategoryManagementForm;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
final class Create extends Component
{
    use WithFileUploads;

    public CategoryManagementForm $form;

    public function save()
    {
        try {
            $this->form->store();

            Flux::toast(
                heading: __('Category Created'),
                text: __('Category has been created successfully.'),
                variant: 'success',
            );

            $this->form->reset();

            $this->redirect(route('admin.categories.index'), navigate: true);
        } catch (CategoryCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: __('Something went wrong'),
                text: __('Error while saving category: ') . $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    /*
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
    */

    public function updatedFormName(string $name)
    {
        $this->form->slug = str()->slug($name);
    }

    public function render()
    {
        return view('livewire.admin.categories.create');
    }
}
