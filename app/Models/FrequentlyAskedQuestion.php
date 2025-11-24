<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class FrequentlyAskedQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\FrequentlyAskedQuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'is_published',
    ];

    protected $casts = [
        'question' => 'array',
        'answer' => 'array',
        'is_published' => 'boolean',
    ];
}
