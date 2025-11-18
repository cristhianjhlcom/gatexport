<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\Admin\CategoryManagementForm;
use App\Models\Category;
use Exception;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class CategoryEditManagement extends Component
{
    use WithFileUploads;

    public CategoryManagementForm $form;

    public function mount(Category $category)
    {
        $this->form->setCategory($category);
    }

    public function save()
    {
        $this->authorize('update', $this->form->category);

        try {
            $this->form->update();

            Flux::toast('La categoría ha sido actualizada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.categories.index'), navigate: true);
        } catch (Exception $exception) {
            report($exception);

            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function createAnother()
    {
        $this->authorize('update', Category::class);

        try {
            $this->form->update();

            Flux::toast('La categoría ha sido actualizada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.categories.create'), navigate: true);
        } catch (Exception $exception) {
            report($exception);

            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.edit')
            ->title('Editar Categoría | Administración');
    }
}
