<?php

declare(strict_types=1);

namespace App\Exceptions\Product\Store;

use Exception;

final class OrderCreationException extends Exception
{
    public static function cannotCreateOrder(): self
    {
        return new self(__('messages.public.product.error.message'), 500);
    }
}
