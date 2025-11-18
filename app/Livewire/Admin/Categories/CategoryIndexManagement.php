<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Exception;
use Flux\Flux;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
final class CategoryIndexManagement extends Component
{
    use AuthorizesRequests, WithPagination;

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
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $e->getMessage(),
                variant: 'error',
            );
        }
    }
}
