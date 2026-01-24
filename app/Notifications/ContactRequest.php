<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class ContactRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva Solicitud de Contacto')
            ->greeting('¡Nueva Solicitud de Contacto!')
            ->line("**Nombre:** {$this->name}")
            ->line("**Email:** {$this->email}")
            ->line("**Teléfono:** {$this->phone}")
            ->action('Ver en HubSpot', 'https://app.hubspot.com/contacts')
            ->line('Este contacto ha sido registrado automáticamente en HubSpot CRM.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
