<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogFile extends Model
{
    /** @use HasFactory<\Database\Factories\CatalogFileFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'filepath',
    ];
}
