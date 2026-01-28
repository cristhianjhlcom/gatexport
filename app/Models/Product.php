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
        'slug_en',
        'description',
        'seo_title',
        'seo_description',
        'status',
        'position',
        'subcategory_id',
    ];

    public function casts(): array
    {
        return [
            'status' => ProductStatusEnum::class,
            'position' => 'integer',
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
        if (! $this->relationLoaded('images')) {
            $this->load(['images']);
        }

        return Attribute::make(
            get: function () {
                if ($this->images->count() > 0) {
                    return $this->images->first()->url;
                }

                return '';
            },
        );
    }

    public function localizedSlug(): Attribute
    {
        return Attribute::make(
            get: function () {
                $locale = app()->getLocale();

                if ($locale === 'en' && ! empty($this->slug_en)) {
                    return $this->slug_en;
                }

                return $this->slug;
            },
        );
    }

    public function showUrl(): Attribute
    {
        if (! $this->relationLoaded('subcategory')) {
            $this->load(['subcategory', 'subcategory.category']);
        }

        return Attribute::make(
            fn () => route('products.show', [
                'category' => $this->subcategory->category->localizedSlug,
                'subcategory' => $this->subcategory->localizedSlug,
                'product' => $this->localizedSlug,
            ])
        );
    }

    /**
     * Resolve the model for route model binding by id, slug, or slug_en.
     */
    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('id', $value)
            ->orWhere('slug', $value)
            ->orWhere('slug_en', $value)
            ->first();
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

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position', 'desc')->orderBy('created_at', 'desc');
    }

    public function published(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->status === ProductStatusEnum::PUBLISHED;
            },
        );
    }
}
