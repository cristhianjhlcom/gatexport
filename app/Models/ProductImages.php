<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImages extends Model
{
    protected $fillable = [
        'url',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
