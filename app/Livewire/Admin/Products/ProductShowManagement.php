<?php

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ProductShowManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.products.show');
    }
}
