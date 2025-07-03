<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

final class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_description',
        'status',
        'subcategory_id',
    ];

    public function casts(): array
    {
        return [
            'status' => ProductStatusEnum::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function createdAtHuman(): string
    {
        return $this->created_at->locale('es')->diffForHumans();
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

    public function getFirstImageAttribute(): string
    {
        if ($this->images->count() > 0) {
            return $this->images->first()->getUrlAttribute();
        }

        return '';
    }
}
