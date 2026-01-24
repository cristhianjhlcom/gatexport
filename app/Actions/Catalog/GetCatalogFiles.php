<?php

declare(strict_types=1);

namespace App\Actions\Catalog;

use App\Models\CatalogFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GetCatalogFiles
{
    public function execute()
    {
        return Cache::remember('catalog_files', now()->addWeek(), function () {
            return DB::transaction(function () {
                $results = CatalogFile::query()
                    ->latest()
                    ->get();

                return $results ??= [];
            });
        });
    }
}
