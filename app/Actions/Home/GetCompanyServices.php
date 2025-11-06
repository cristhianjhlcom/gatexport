<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class GetCompanyServices
{
    public function execute(): array
    {
        $locale = app()->getLocale();

        return Cache::remember("company_services_{$locale}", now()->addWeek(), function () use ($locale) {
            return DB::transaction(function () use ($locale) {

                $setting = Setting::where('key', 'company_services')
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
