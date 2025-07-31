<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Livewire\Forms\Admin\CategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class CategoryCreateManagement extends Component
{
    use WithFileUploads;

    public CategoryManagementForm $form;

    public function save()
    {
        $this->authorize('create', Category::class);

        try {
            $this->form->store();

            Flux::toast('La categoría ha sido creada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.categories.index'), navigate: true);
        } catch (\Exception $exception) {
            report($exception);

            Flux::toast(
                heading: 'Uops! Algo salió mal',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function updatedFormNameEs(string $name): void
    {
        $this->form->slug = str()->slug($name);
    }

    public function createAnother()
    {
        $this->authorize('create', Category::class);

        try {
            $this->form->store();

            Flux::toast('La categoría ha sido creada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.categories.create'), navigate: true);
        } catch (\Exception $exception) {
            report($exception);

            Flux::toast(
                heading: 'Uops! Algo salió mal',
                text: $exception->getMessage(),
                variant: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.create')
            ->title('Crear Categoría | Administración');
    }
}
