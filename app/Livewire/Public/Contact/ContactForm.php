<?php

declare(strict_types=1);

namespace App\Livewire\Public\Contact;

use App\Enums\RolesEnum;
use App\Models\User;
use App\Notifications\ContactRequest;
use App\Services\HubSpot\HubSpotService;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class ContactForm extends Component
{
    #[Validate]
    public string $name = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $phone = '';

    public function updatedName(string $name): void
    {
        $this->name = str()->title($name);
    }

    public function submit(HubSpotService $hubspot)
    {
        $validated = $this->validate();

        try {
            $hubspot->createOrGetContact($validated);

            $users = User::role([RolesEnum::SUPER_ADMIN->value])->get();

            Notification::send($users, new ContactRequest(
                name: $validated['name'],
                email: $validated['email'],
                phone: $validated['phone'],
            ));

            $this->reset(['name', 'email', 'phone']);

            Flux::toast(
                heading: __('messages.public.contact.success.title'),
                text: __('messages.public.contact.success.message'),
                variant: 'success',
            );

            Flux::modal('contact-form')->close();
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: __('messages.public.contact.error.title'),
                text: __('messages.public.contact.error.message'),
                variant: 'danger',
            );

            $this->reset(['name', 'email', 'phone']);
        }
    }

    public function render()
    {
        return view('livewire.public.contact.contact-form');
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|between:3,100',
            'email' => 'required|email|between:3,100',
            'phone' => 'required|string|between:6,12',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => mb_strtolower(__('pages.contact.name')),
            'email' => mb_strtolower(__('pages.contact.email')),
            'phone' => mb_strtolower(__('pages.contact.phone')),
        ];
    }
}
