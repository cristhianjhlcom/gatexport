<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class OrderShowManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
