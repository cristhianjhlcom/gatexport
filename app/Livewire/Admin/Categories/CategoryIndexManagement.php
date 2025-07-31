<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
final class CategoryIndexManagement extends Component
{
    use WithPagination, AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', Category::class);

        try {
            $categories = Category::with(['subcategories'])
                ->withCount(['subcategories'])
                ->latest()
                ->paginate(10);

            return view('livewire.admin.categories.index')
                ->with([
                    'categories' => $categories,
                ])
                ->title('Lista de Categorías | Administración');
        } catch (\Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Uops! Algo salió mal',
                text: $e->getMessage(),
                variant: 'error',
            );
        }
    }
}
