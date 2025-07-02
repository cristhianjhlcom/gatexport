<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subcategories;

use App\Models\Subcategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
final class SubcategoryIndexManagement extends Component
{
    use WithPagination;

    public function render()
    {
        $subcategories = Subcategory::with('category')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.subcategories.index')->with([
            'subcategories' => $subcategories,
        ]);
    }
}
