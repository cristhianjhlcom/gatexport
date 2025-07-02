<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

final class ProductImages extends Model
{
    protected $fillable = [
        'product_id',
        'filename',
        'original_name',
        'path',
        'mime_type',
        'size',
        'width',
        'height',
        'order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor para URL completa
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    // Accessor para tamaño legible
    public function getReadableSizeAttribute()
    {
        return Number::fileSize($this->size);
    }
}
