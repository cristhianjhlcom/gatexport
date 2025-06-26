<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatusEnum: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => __('Draft'), // NOTE: Orden en borrador.
            self::SENT => __('Sent'), // NOTE: Enviada al cliente.
            self::ACCEPTED => __('Accepted'), // NOTE: Aceptada por el cliente.
            self::REJECTED => __('Rejected'), // NOTE: Rechazada por el cliente.
            self::CANCELLED => __('Cancelled'), // NOTE: Cancelada por el manager.
            self::COMPLETED => __('Completed'), // NOTE: Finalizada con éxito.
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'red',
            self::SENT => 'green',
            self::ACCEPTED => 'green',
            self::REJECTED => 'red',
            self::CANCELLED => 'red',
            self::COMPLETED => 'green',
        };
    }
}
