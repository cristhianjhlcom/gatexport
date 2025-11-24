<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Policy extends Model
{
    /** @use HasFactory<\Database\Factories\PolicyFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_published',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_published' => 'boolean',
    ];
}
