<?php

declare(strict_types=1);

namespace App\Services\Setting;

use App\Models\Setting;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class CountryManagementService
{
    use ImageUploads;

    private array $locales = ['es', 'en'];

    public function load()
    {
        $data = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->locales as $locale) {
            $results = Setting::getByLocale('export_countries', $locale);

            $data[$locale] = $results ??= [];
        }

        return $data;
    }

    public function save(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->locales as $locale) {
                $value = [];

                foreach ($data['continents'][$locale] as $idx => $continent) {
                    $value[] = [
                        'title' => $continent['title'],
                        'position' => $continent['position'] ??= $idx,
                        'image' => $this->upload([
                            'newFile' => $data['tmpImages'][$locale][$idx] ??= null,
                            'currentPath' => $continent['image'] ??= null,
                            'directory' => 'uploads/settings/countries',
                            'disk' => 'public',
                        ]),
                    ];
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'export_countries',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => $value,
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }
}
