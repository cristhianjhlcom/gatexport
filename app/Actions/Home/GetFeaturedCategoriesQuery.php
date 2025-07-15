<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class GetFeaturedCategoriesQuery
{
    public function handle(): Collection
    {
        $result =  DB::transaction(function () {
            return Category::with('subcategories')
                ->orderBy('name')
                ->limit(4)
                ->get();
        });

        // NOTE: podemos llamar broadcast aqui para notificar
        return $result;
    }
}
