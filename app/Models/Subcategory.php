<?php

declare(strict_types=1);

namespace App\Models;

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
        'category_id',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'name' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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

    public function localizedName($locale = null): Attribute
    {
        $locale = $locale ?? app()->getLocale();

        return Attribute::make(
            get: fn() => $this->name[$locale],
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
