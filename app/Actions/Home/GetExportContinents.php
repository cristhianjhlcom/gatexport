<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;

final class GetExportContinents
{
    public function execute(): array
    {
        $continents = Setting::get('export_countries', []);
        $mappedContinents = [];

        foreach ($continents as $continent) {
            $exportedCountries = array_values(array_filter($continent['countries'], function ($country) {
                return $country['export'];
            }));
            $countries = array_map(function ($country) {
                return [
                    'id' => str()->slug($country['name']),
                    'name' => $country['name'],
                    'code' => $country['code'],
                ];
            }, $exportedCountries);
            $mappedContinents[] = [
                'id' => str()->slug($continent['name']),
                'name' => $continent['name'],
                'countries' => $countries,
            ];
        }

        return array_filter($mappedContinents, function ($continent) {
            return count($continent['countries']) > 0;
        });
    }
}
