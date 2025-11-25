<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
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
}
