<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'subcategory_id',
    ];

    public function casts(): array
    {
        return [
            'id' => 'string',
            'status' => ProductStatusEnum::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class);
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecifications::class);
    }
}
