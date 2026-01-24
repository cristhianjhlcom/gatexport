<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class ProductInquiryReceived extends Notification
{
    use Queueable;

    public function __construct(
        public Product $product,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public int $quantity,
        public string $notes,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva Consulta de Producto')
            ->greeting('¡Nueva Consulta de Producto!')
            ->line("Se ha recibido una consulta sobre el producto: **{$this->product->localizedName}**")
            ->line("**Cliente:** {$this->firstName} {$this->lastName}")
            ->line("**Email:** {$this->email}")
            ->line("**Teléfono:** {$this->phone}")
            ->line("**Cantidad:** {$this->quantity}")
            ->line("**Notas:** {$this->notes}")
            ->action('Ver en HubSpot', 'https://app.hubspot.com/contacts')
            ->line('Esta consulta ha sido registrada automáticamente en HubSpot CRM.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->localizedName,
            'customer_name' => "{$this->firstName} {$this->lastName}",
            'customer_email' => $this->email,
            'customer_phone' => $this->phone,
            'quantity' => $this->quantity,
        ];
    }
}
