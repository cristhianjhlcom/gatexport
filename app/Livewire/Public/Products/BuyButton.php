<?php

declare(strict_types=1);

namespace App\Livewire\Public\Products;

use App\Actions\Product\Store\RequestOrderAction;
use App\Exceptions\Product\Store\OrderCreationException;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class BuyButton extends Component
{
    public Product $product;

    #[Validate]
    public int $quantity = 1;

    #[Validate]
    public string $firstName;

    #[Validate]
    public string $lastName;

    #[Validate]
    public string $email;

    #[Validate]
    public string $phone;

    #[Validate]
    public string $notes;

    public function createOrder(RequestOrderAction $create)
    {
        $validated = $this->validate();

        try {
            $create($this->product, $validated);

            $this->reset(['quantity', 'firstName', 'lastName', 'email', 'phone', 'notes']);

            Flux::toast(
                heading: __('messages.public.product.success.title'),
                text: __('messages.public.product.success.message'),
                variant: 'success',
            );

            Flux::modal('call-to-action')->close();
        } catch (OrderCreationException $e) {
            report($e);

            Flux::toast(
                heading: __('messages.public.product.error.title'),
                text: $e->getMessage(),
                variant: 'danger',
            );

            $this->reset(['quantity', 'firstName', 'lastName', 'email', 'phone', 'notes']);
        }
    }

    public function render()
    {
        return view('livewire.public.products.buy-button');
    }

    protected function rules(): array
    {
        return [
            'firstName' => 'required|string|max:90',
            'lastName' => 'required|string|max:90',
            'email' => 'required|string|email|max:90',
            'phone' => 'required|string|between:6,12',
            'notes' => 'required|string|between:3,2000',
            'quantity' => 'required|integer|min:1|max:10',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'firstName' => mb_strtolower(__('pages.product.first_name')),
            'lastName' => mb_strtolower(__('pages.product.last_name')),
            'email' => mb_strtolower(__('pages.product.email')),
            'phone' => mb_strtolower(__('pages.product.phone')),
            'notes' => mb_strtolower(__('pages.product.notes')),
        ];
    }
}
