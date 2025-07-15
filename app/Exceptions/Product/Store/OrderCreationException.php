<?php

declare(strict_types=1);

namespace App\Exceptions\Product\Store;

final class OrderCreationException extends \Exception
{
    public static function cannotCreateOrder(): self
    {
        return new self("Cannot create the order, try again later.", 500);
    }
}
