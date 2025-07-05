<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Orders;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Order')]
final class OrderEditManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.orders.edit');
    }
}
