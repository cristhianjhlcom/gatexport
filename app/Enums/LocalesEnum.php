<?php

declare(strict_types=1);

namespace App\Enums;

enum LocalesEnum: string
{
    case ES = 'es';
    case EN = 'en';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function code(): string
    {
        return match ($this) {
            self::ES => __('ES'),
            self::EN => __('EN'),
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ES => __('Spanish'),
            self::EN => __('English'),
        };
    }
}
