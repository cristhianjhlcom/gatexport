<?php

declare(strict_types=1);

namespace App\Livewire\Public\Products;

use App\Actions\Product\Store\RequestOrderAction;
use App\Exceptions\Product\Store\OrderCreationException;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class CallToAction extends Component
{
    public Product $product;

    #[Validate]
    public int $quantity = 1;

    #[Validate]
    public string $firstName = '';

    #[Validate]
    public string $lastName = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $phone = '';

    #[Validate]
    public ?string $notes = null;

    public function createOrder(RequestOrderAction $create)
    {
        $validated = $this->validate();

        try {
            $create($this->product, $validated);

            $this->reset(['quantity', 'firstName', 'lastName', 'email', 'phone', 'notes']);

            Flux::modal('call-to-action')->close();
            Flux::toast(
                heading: __('Order created successfully'),
                text: __('Someone will contact you soon.'),
                variant: 'success',
            );
        } catch (OrderCreationException $e) {
            report($e);
            Flux::toast(
                heading: __('Oops! Something went wrong'),
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function render()
    {
        return view('livewire.public.products.call-to-action');
    }

    protected function rules(): array
    {
        return [
            'firstName' => 'required|string|min:3|max:90',
            'lastName' => 'required|string|min:3|max:90',
            'email' => 'required|string|email|max:90',
            'phone' => 'required|string|max:255',
            'notes' => 'nullable|string|min:3|max:255',
            'quantity' => 'required|integer|min:1|max:10',
        ];
    }

    protected function messages()
    {
        return [
            'firstName.required' => 'The :attribute is required.',
            'firstName.min' => 'The :attribute must be at least :min characters.',
            'firstName.max' => 'The :attribute must be at most :max characters.',
            'lastName.required' => 'The :attribute is required.',
            'lastName.min' => 'The :attribute must be at least :min characters.',
            'lastName.max' => 'The :attribute must be at most :max characters.',
            'email.required' => 'The :attribute is required.',
            'email.email' => 'The :attribute must be a valid email address.',
            'email.max' => 'The :attribute must be at most :max characters.',
            'phone.required' => 'The :attribute is required.',
            'phone.max' => 'The :attribute must be at most :max characters.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'firstName' => __('First Name'),
            'lastName' => __('Last Name'),
            'email' => __('Email'),
            'phone' => __('Phone Number'),
        ];
    }
}
