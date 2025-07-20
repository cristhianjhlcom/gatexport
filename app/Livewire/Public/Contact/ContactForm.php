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
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ];

    protected $messages = [
        'name.required' => 'The :attribute is required.',
        'name.max' => 'The :attribute must be at most :max characters.',
        'email.required' => 'The :attribute is required.',
        'email.email' => 'The :attribute must be a valid email address.',
        'email.max' => 'The :attribute must be at most :max characters.',
        'message.required' => 'The :attribute is required.',
        'message.max' => 'The :attribute must be at most :max characters.',
    ];

    protected $validationAttributes = [
        'name' => 'Name',
        'email' => 'Email',
        'message' => 'Message',
    ];

    public function mount()
    {
        $generalInformation = (new GetGeneralInformation)->execute();

        $this->companyEmail = $generalInformation['contact_information']['email'] ?? '';
    }

    public function submit()
    {
        $this->validate();

        // Example email sending logic
        Mail::send([], [], function ($message) {
            $message->to($this->companyEmail)
                ->subject('Contact Form Submission')
                ->setBody("Name: $this->name\nEmail: $this->email\nMessage: $this->message");
        });

        $this->reset();

        Flux::toast(
            heading: __('Message Sent'),
            text: __('Your message has been sent successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.public.contact.contact-form');
    }
}
