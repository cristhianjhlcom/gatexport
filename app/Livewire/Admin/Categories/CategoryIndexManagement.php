<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
final class CategoryIndexManagement extends Component
{
    public function render()
    {
        $categories = Category::withCount(['subcategories'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.categories.index')->with([
            'categories' => $categories,
        ]);
    }
}
