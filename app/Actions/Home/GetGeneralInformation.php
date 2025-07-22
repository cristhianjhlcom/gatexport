<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

final class GetGeneralInformation
{
    public function execute(): array
    {
        $result = DB::transaction(function () {
            $locale = app()->getLocale();

            $setting = Setting::where('key', 'general_info')
                ->where('group', 'general')
                ->where('locale', $locale)
                ->first();

            if (! $setting) {
                return [];
            }

            return $setting->value;
        });

        return $result;
    }
}
