<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

final class Subcategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubcategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'position',
        'category_id',
        'background_color',
        'background_image',
        'icon_white',
        'icon_primary',
        'description',
        'seo_image',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'name' => 'array',
        'background_image' => 'array',
        'description' => 'array',
        'seo_title' => 'array',
        'seo_description' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position', 'desc')->orderBy('created_at', 'desc');
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->image) {
                    return Storage::disk('public')->url($this->image);
                }

                return '';
            },
        );
    }

    public function iconWhiteUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->icon_white) {
                    return Storage::disk('public')->url($this->icon_white);
                }

                return null;
            },
        );
    }

    public function iconPrimaryUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->icon_primary) {
                    return Storage::disk('public')->url($this->icon_primary);
                }

                return null;
            },
        );
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

    public function localizedBackgroundImage($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: function () use ($locale) {
                if (! is_array($this->background_image)) {
                    return null;
                }

                return $this->background_image[$locale] ?? null;
            },
        );
    }

    public function indexUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => route('admin.subcategories.index', [
                'category' => $this->category->slug,
                'subcategory' => $this->slug,
            ]),
        );
    }

    public function createdAtHuman(): string
    {
        return $this->created_at->locale('es')->diffForHumans();
    }

    public function formattedCreatedAt(): string
    {
        return $this->created_at->locale('es')->format('d/m/Y, H:i A');
    }
}
