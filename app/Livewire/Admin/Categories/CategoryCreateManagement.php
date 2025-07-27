<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Exceptions\Admin\CategoryCreationException;
use App\Livewire\Forms\Admin\CategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Illuminate\Container\Attributes\DB;
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
            DB::transaction(function () {
                $this->form->store();

                Flux::toast(
                    heading: 'Manejo de Sistema',
                    text: 'La categoría ha sido creada correctamente.',
                    variant: 'success',
                );

                $this->form->reset();

                $this->redirect(route('admin.categories.index'), navigate: true);
            });
        } catch (CategoryCreationException $exception) {
            report($exception);

            Flux::toast(
                heading: 'Uops! Algo salió mal',
                text: $exception->getMessage(),
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
        return view('livewire.admin.categories.create')
            ->title('Crear Categoría | Administración');
    }
}
