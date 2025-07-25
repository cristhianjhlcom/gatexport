<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('List of Products')]
final class ProductIndexManagement extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::with(['images', 'subcategory', 'subcategory.category', 'specifications'])
            ->latest()
            ->withCount('specifications')
            ->paginate(10);

        return view('livewire.admin.products.index')->with([
            'products' => $products,
        ]);
    }
}
