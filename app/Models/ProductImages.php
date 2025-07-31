<?php

declare(strict_types=1);

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

final class ProductImages extends Model
{
    use HasFactory;

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

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->path),
        );
    }

    public function readableSize(): Attribute
    {
        return Attribute::make(
            get: fn () => Number::fileSize($this->size),
        );
    }
}
