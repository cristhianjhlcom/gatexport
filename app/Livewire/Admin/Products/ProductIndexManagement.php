<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ProductIndexManagement extends Component
{
    public function render()
    {
        $products = Product::with(['images', 'subcategory', 'specifications'])
            ->withCount('specifications')
            ->paginate(10);


        return view('livewire.admin.products.index')->with([
            'products' => $products,
        ]);
    }
}
