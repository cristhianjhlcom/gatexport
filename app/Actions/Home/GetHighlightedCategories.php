<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GetHighlightedCategories
{
    public function execute(): array
    {
        $locale = app()->getLocale();

        return Cache::remember("highlighted_categories_{$locale}", now()->addWeek(), function () use ($locale) {
            return DB::transaction(function () use ($locale) {

                $setting = Setting::where('key', 'highlighted_categories')
                    ->where('group', 'home')
                    ->where('locale', $locale)
                    ->first();

                if (! $setting) {
                    return [];
                }

                return $setting->value;
            });
        });
    }
}
