<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

final class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'summary',
        'is_published',
        'thumbnail',
        'seo_title',
        'seo_content',
        'seo_thumbnail',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'summary' => 'array',
        'is_published' => 'boolean',
        'seo_title' => 'array',
        'seo_description' => 'array',
    ];

    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->thumbnail) return Storage::disk('public')->url($this->thumbnail);

                return NULL;
            },
        );
    }

    public function thumbnailSize(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->thumbnail) return Storage::disk('public')->size($this->thumbnail);

                return NULL;
            },
        );
    }

    public function seoThumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->seo_thumbnail) return Storage::disk('public')->url($this->seo_thumbnail);

                return NULL;
            },
        );
    }

    public function seoThumbnailSize(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->seo_thumbnail) return Storage::disk('public')->size($this->seo_thumbnail);

                return NULL;
            },
        );
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function localizedTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->title[app()->getLocale()] ?? $this->title['es'] ?? null,
        );
    }

    public function localizedSeoTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->seo_title[app()->getLocale()] ?? $this->seo_title['es'] ?? null,
        );
    }

    public function localizedSummary(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->summary[app()->getLocale()] ?? $this->summary['es'] ?? null,
        );
    }

    public function localizedContent(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->content[app()->getLocale()] ?? $this->content['es'] ?? null,
        );
    }

    public function localizedSeoDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->seo_description[app()->getLocale()] ?? $this->seo_description['es'] ?? null,
        );
    }

    public function dateForHumans(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at->locale(app()->getLocale())->translatedFormat('d F, Y'),
        );
    }

    public function showUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => route('articles.show', $this),
        );
    }

    public function indexUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => route('articles.index'),
        );
    }
}
