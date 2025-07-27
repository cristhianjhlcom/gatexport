<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Exceptions\Admin\CategoryCreationException;
use App\Livewire\Forms\Admin\CategoryManagementForm;
use App\Models\Category;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
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
            DB::transaction(function () {
                $this->form->update();

                Flux::toast(
                    heading: 'Manejo de Sistema',
                    text: 'La categoría ha sido actualizada correctamente.',
                    variant: 'success',
                );

                $this->form->reset();

                $this->redirect(route('admin.categories.index'), navigate: true);
            });
        } catch (CategoryCreationException $e) {
            report($e);

            Flux::toast(
                heading: 'Uops! Algo salió mal',
                text: $e->getMessage(),
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
