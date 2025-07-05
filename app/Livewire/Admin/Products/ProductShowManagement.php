<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Show Product')]
final class ProductShowManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.products.show');
    }
}
