<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class GetFeaturedCategories
{
    public function execute(): Collection
    {
        $result = DB::transaction(function () {
            return Category::with([
                'subcategories.products' => function ($query) {
                    $query->where('status', ProductStatusEnum::PUBLISHED)->limit(4);
                },
            ])
                ->orderBy('name')
                ->limit(4)
                ->get();
        });

        foreach ($result as $category) {
            if ($category->relationLoaded('subcategories')) {
                $category->setRelation('subcategories', $category->subcategories->take(1));
            }
        }

        // NOTE: podemos llamar broadcast aqui para notificar
        return $result;
    }
}
