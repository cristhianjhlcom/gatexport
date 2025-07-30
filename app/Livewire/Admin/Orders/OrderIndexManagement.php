<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
final class OrderIndexManagement extends Component
{
    public function toggleStatus(Order $order)
    {
        if ($order->status === OrderStatusEnum::COMPLETED) {
            $order->update([
                'status' => OrderStatusEnum::DRAFT,
            ]);
            return;
        }

        $order->update([
            'status' => OrderStatusEnum::COMPLETED,
        ]);
    }

    public function render()
    {
        $orders = Order::with(['manager', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.orders.index')->with([
            'orders' => $orders,
        ])
            ->title('Manejo de Ordenes');
    }
}
