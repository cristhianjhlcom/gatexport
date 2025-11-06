<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GetCompetitiveAdvantages
{
    public function execute(): array
    {
        $locale = app()->getLocale();

        return Cache::remember("competitive_advantages_{$locale}", now()->addWeek(), function () use ($locale) {
            return DB::transaction(function () use ($locale) {

                $setting = Setting::where('key', 'competitive_advantages')
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
