<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

final class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'position',
        'background_image',
        'background_color',
        'icon_white',
        'icon_primary',
        'description',
        'seo_image',
        'seo_title',
        'seo_description',
    ];

    /**
     * Cast JSON columns to arrays.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'name' => 'array',
        'background_image' => 'array',
        'description' => 'array',
        'seo_title' => 'array',
        'seo_description' => 'array',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
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
            get: fn() => $this->name[$locale],
        );
    }

    public function localizedDescription($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn() => $this->description[$locale],
        );
    }

    public function localizedSeoTitle($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn() => $this->seo_title[$locale],
        );
    }

    public function localizedSeoDescription($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn() => $this->seo_description[$locale],
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

    public function createdAtHuman(): string
    {
        return $this->created_at->locale('es')->diffForHumans();
    }

    public function formattedCreatedAt(): string
    {
        return $this->created_at->locale('es')->format('d/m/Y, H:i A');
    }
}
