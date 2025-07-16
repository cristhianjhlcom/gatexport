<?php

declare(strict_types=1);

namespace App\Actions\Product\Store;

use App\Enums\RolesEnum;
use App\Exceptions\Product\Store\OrderCreationException;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class RequestOrderAction
{
    public function __invoke(Product $product, array $data): Order
    {
        return DB::transaction(function () use ($product, $data) {
            // TODO: Cambiar a role admin.
            $admin = User::role(RolesEnum::SUPER_ADMIN)->first();

            if ($admin === null) {
                throw OrderCreationException::cannotCreateOrder();
            }

            $order = Order::create([
                'customer_firstname' => $data['firstName'],
                'customer_lastname' => $data['lastName'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'manager_id' => $admin->id,
                'notes' => $data['notes'],
            ]);

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $data['quantity'],
            ]);

            return $order->fresh();
        });
    }
}
