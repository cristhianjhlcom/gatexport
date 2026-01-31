<?php

declare(strict_types=1);

namespace App\Livewire\Public\Products;

use App\Enums\RolesEnum;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductInquiryReceived;
use App\Services\HubSpot\HubSpotService;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class BuyButton extends Component
{
    public Product $product;

    #[Validate]
    public string $firstName = '';

    #[Validate]
    public string $lastName = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $phone = '';

    public function updatedFirstName()
    {
        $this->firstName = str()->title($this->firstName);
    }

    public function updatedLastName()
    {
        $this->lastName = str()->title($this->lastName);
    }

    public function createOrder(HubSpotService $hubspot)
    {
        $validated = $this->validate();

        try {
            $interest = [
                'product_name' => $this->product->localizedName,
                'product_url' => $this->product->showUrl,
            ];
            // $contactId = $hubspot->createOrGetContact($validated);
            $hubspot->createDeals([
                'payload' => $validated,
                'interest' => $interest,
            ]);

            $users = User::role([RolesEnum::SUPER_ADMIN->value])->get();

            Notification::send($users, new ProductInquiryReceived(
                product: $this->product,
                firstName: $validated['firstName'],
                lastName: $validated['lastName'],
                email: $validated['email'],
                phone: $validated['phone'],
                interest: $interest,
            ));

            $this->reset(['firstName', 'lastName', 'email', 'phone']);

            Flux::toast(
                heading: __('messages.public.product.success.title'),
                text: __('messages.public.product.success.message'),
                variant: 'success',
            );

            Flux::modal('call-to-action')->close();
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: __('messages.public.product.error.title'),
                text: __('messages.public.product.error.message'),
                variant: 'danger',
            );

            $this->reset(['firstName', 'lastName', 'email', 'phone']);
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
        ];
    }

    protected function validationAttributes()
    {
        return [
            'firstName' => mb_strtolower(__('pages.product.first_name')),
            'lastName' => mb_strtolower(__('pages.product.last_name')),
            'email' => mb_strtolower(__('pages.product.email')),
            'phone' => mb_strtolower(__('pages.product.phone')),
        ];
    }
}
