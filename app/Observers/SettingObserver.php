<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

final class SettingObserver
{
    public function saved(Setting $setting): void
    {
        $this->clearSettingsCache($setting);
    }

    public function deleted(Setting $setting): void
    {
        $this->clearSettingsCache($setting);
    }

    private function clearSettingsCache(Setting $setting): void
    {
        if ($setting->key === 'export_countries' && $setting->group === 'home') {
            Cache::forget("export_continents_{$setting->locale}");
        }

        if ($setting->key === 'banners' && $setting->group === 'home') {
            Cache::forget("home_heros_{$setting->locale}");
        }

        if ($setting->key === 'general_info' && $setting->group === 'general') {
            Cache::forget("general_information_{$setting->locale}");
            Cache::forget('company_logos');
        }

        if ($setting->key === 'about' && $setting->group === 'about') {
            Cache::forget("about_{$setting->locale}");
        }

        if ($setting->key === 'competitive_advantages' && $setting->group === 'home') {
            Cache::forget("competitive_advantages_{$setting->locale}");
        }

        if ($setting->key === 'highlighted_categories' && $setting->group === 'home') {
            Cache::forget("highlighted_categories_{$setting->locale}");
        }

        if ($setting->key === 'company_services' && $setting->group === 'home') {
            Cache::forget("company_services_{$setting->locale}");
        }
    }
}
