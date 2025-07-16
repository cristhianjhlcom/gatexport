<?php

declare(strict_types=1);

namespace App\Actions\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class GetCompanyLogos
{
    public function execute(): array
    {
        return DB::transaction(function () {
            $setting = Setting::where('key', 'general_info')
                ->where('group', 'general')
                ->first();

            if ($setting) {
                return [
                    'large_logo' => Storage::disk('public')->url($setting->value['large_logo']),
                    'small_logo' => Storage::disk('public')->url($setting->value['small_logo']),
                    'favicon' => Storage::disk('public')->url($setting->value['favicon']),
                ];
            }

            return [
                'large_logo' => '',
                'small_logo' => '',
                'favicon' => '',
            ];
        });
    }
}
