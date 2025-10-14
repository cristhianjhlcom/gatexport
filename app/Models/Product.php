<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
            'name' => 'array',
            'description' => 'array',
            'seo_title' => 'array',
            'seo_description' => 'array',
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

    public function localizedName($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->name[$locale],
        );
    }

    public function localizedDescription($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->description[$locale],
        );
    }

    public function localizedSeoTitle($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->seo_title[$locale],
        );
    }

    public function localizedSeoDescription($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->seo_description[$locale],
        );
    }

    public function localizedCategoryName($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->subcategory->category->name[$locale],
        );
    }

    public function localizedSubcategoryName($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn () => $this->subcategory->name[$locale],
        );
    }

    public function firstImage(): Attribute
    {
        $this->load(['images']);

        return Attribute::make(
            get: function () {
                if ($this->images->count() > 0) {
                    return $this->images->first()->url;
                }

                return '';
            },
        );
    }

    public function showUrl(): Attribute
    {
        $this->load(['subcategory', 'subcategory.category']);

        return Attribute::make(
            fn () => route('products.show', [
                'category' => $this->subcategory->category,
                'subcategory' => $this->subcategory,
                'product' => $this,
            ])
        );
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query
            ->when(
                $search,
                fn (Builder $query) => $query->whereAny(
                    ['name', 'description'],
                    'like',
                    "%{$search}%"
                )
            );
    }
}
