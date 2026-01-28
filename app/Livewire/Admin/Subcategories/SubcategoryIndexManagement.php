<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subcategories;

use App\Models\Subcategory;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('List of Sub Categories')]
final class SubcategoryIndexManagement extends Component
{
    use WithPagination;

    public function delete(Subcategory $subcategory): void
    {
        if ($subcategory->products()->exists()) {
            Flux::toast(
                heading: 'No se puede eliminar',
                text: 'Esta sub-categoría tiene productos asociados. Elimina o mueve los productos antes de continuar.',
                variant: 'danger',
            );

            return;
        }

        $subcategory->delete();

        Flux::toast(
            heading: 'Sub-categoría eliminada',
            text: 'La sub-categoría ha sido eliminada correctamente.',
            variant: 'success',
        );
    }

    public function render()
    {
        $subcategories = Subcategory::with('category')
            ->withCount('products')
            ->ordered()
            ->paginate(10);

        return view('livewire.admin.subcategories.index')->with([
            'subcategories' => $subcategories,
        ]);
    }
}
