<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subcategories;

use App\Livewire\Forms\Admin\SubcategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\{Component, WithFileUploads};

#[Layout('components.layouts.admin')]
final class SubcategoryCreateManagement extends Component
{
    use WithFileUploads;

    public SubcategoryManagementForm $form;

    public function save()
    {
        try {
            $this->form->store();

            Flux::toast('La subcategoría ha sido creada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.subcategories.index'), navigate: true);
        } catch (\Exception $exception) {
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

    public function createAnother()
    {
        $this->authorize('create', Category::class);

        try {
            $this->form->store();

            Flux::toast('La subcategoría ha sido creada correctamente.');

            $this->form->reset();

            $this->redirect(route('admin.subcategories.create'), navigate: true);
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
        return view('livewire.admin.subcategories.create')
            ->with([
                'categories' => Category::orderBy('name')->get(),
            ])
            ->title('Crear Subcategoría | Administración');
    }
}
