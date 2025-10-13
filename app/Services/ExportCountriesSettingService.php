<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

final class ExportCountriesSettingService
{
    protected function formattedContinents(array $continents)
    {
        $data = [];

        foreach ($continents as $continent) {
            $formattedContinent = [
                'name' => $continent['name'],
                'countries' => [],
            ];

            foreach ($continent['countries'] as $country) {
                $formattedContinent['countries'][] = [
                    'name' => $country['name'],
                    'code' => $country['code'],
                    'export' => (bool) $country['export'],
                ];
            }

            $data[] = $formattedContinent;
        }

        return $data;
    }

    public function load()
    {
        $exportCountries = Setting::get('export_countries', []);

        if (array_key_exists('continents', $exportCountries)) {
            return $this->formattedContinents($exportCountries['continents']);
        }

        return $this->formattedContinents($exportCountries);
    }

    public function save(array $data)
    {
        $value = $this->formattedContinents($data);

        DB::transaction(function () use ($value) {
            Setting::updateOrCreate(
                [
                    'key' => 'export_countries',
                    'locale' => 'es',
                    'group' => 'home',
                ],
                [
                    'value' => $value,
                    'type' => 'json',
                    'is_public' => true,
                ]
            );
        });
    }
}
