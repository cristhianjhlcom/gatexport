<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductStatusEnum: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';

    public function label(): string
    {
        return match ($this) {
            self::PUBLISHED => __('Published'),
            self::DRAFT => __('Draft'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function color(): string
    {
        return match ($this) {
            self::PUBLISHED => 'green',
            self::DRAFT => 'red',
        };
    }
}
