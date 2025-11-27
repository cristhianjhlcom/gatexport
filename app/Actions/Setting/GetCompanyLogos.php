<?php

declare(strict_types=1);

namespace App\Actions\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

final class GetCompanyLogos
{
    public function execute()
    {
        return Cache::rememberForever('company_logos', function () {
            $setting = Setting::where('key', 'general_info')
                ->where('group', 'general')
                ->first();

            return [
                'large_logo' => $this->getValidUrl($setting->value['large_logo']),
                'small_logo' => $this->getValidUrl($setting->value['small_logo']),
                'white_logo' => $this->getValidUrl($setting->value['white_logo']),
                'special_logo' => $this->getValidUrl($setting->value['special_logo']),
            ];
        });
    }

    private function getValidUrl(?string $path): string
    {
        if (!$path || $path === '') return '';

        return Storage::disk('public')->url($path);
    }
}
