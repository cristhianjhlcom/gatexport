<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('List of Order')]
final class OrderIndexManagement extends Component
{
    public function render()
    {
        $orders = Order::with(['manager', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.orders.index')->with([
            'orders' => $orders,
        ]);
    }
}
