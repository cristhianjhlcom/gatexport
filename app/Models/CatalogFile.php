<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CatalogFile extends Model
{
    /** @use HasFactory<\Database\Factories\CatalogFileFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'filepath',
    ];

    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'filepath' => 'array',
    ];

    public function fileUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $filepath = $this->filepath[app()->getLocale()] ?? null;

                if ($filepath) {
                    return Storage::disk('public')->url($filepath);
                }

                return null;
            },
        );
    }
}
