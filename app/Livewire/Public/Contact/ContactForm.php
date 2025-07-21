<?php

declare(strict_types=1);

namespace App\Livewire\Public\Contact;

use App\Actions\Home\GetGeneralInformation;
use Flux\Flux;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    protected string $companyEmail = '';

    protected $rules = [
        'name' => 'required|string|between:3,100',
        'email' => 'required|email|between:3,100',
        'message' => 'required|string|max:1000',
    ];

    protected function getValidationAttributes()
    {
        return [
            'name' => strtolower(__('pages.contact.name')),
            'email' => strtolower(__('pages.contact.email')),
            'message' => strtolower(__('pages.contact.message')),
        ];
    }

    public function mount()
    {
        $generalInformation = (new GetGeneralInformation)->execute();

        $this->companyEmail = $generalInformation['contact_information']['email'] ?? '';
    }

    public function submit()
    {
        $this->validate();

        Mail::send([], [], function ($message) {
            $message->to($this->companyEmail)
                ->subject('Contact Form Submission')
                ->setBody("Name: $this->name\nEmail: $this->email\nMessage: $this->message");
        });

        $this->reset();

        Flux::toast(
            heading: __('messages.public.contact.success.title'),
            text: __('messages.public.contact.success.message'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.public.contact.contact-form');
    }
}
