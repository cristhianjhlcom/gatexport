<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_firstname',
        'customer_lastname',
        'customer_email',
        'customer_phone',
        'notes',
        'status',
        'manager_id',
        'total_products',
        'total_price',
    ];

    public function casts(): array
    {
        return [
            'id' => 'string',
            'status' => OrderStatusEnum::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItems::class);
    }

    public function customerFullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->customer_firstname.' '.$this->customer_lastname,
        );
    }

    public function formattedCreatedAt(string $format = 'd/m/Y, H:i A', string $locale = 'es'): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->locale($locale)->format($format),
        );
    }
}
