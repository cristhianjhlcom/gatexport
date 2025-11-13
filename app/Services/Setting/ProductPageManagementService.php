<?php

declare(strict_types=1);

namespace App\Services\Setting;

use App\Models\Setting;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\DB;

final class ProductPageManagementService
{
    use ImageUploads;

    private array $locales = ['es', 'en'];

    public function load(): array
    {
        $data = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->locales as $locale) {
            $results = Setting::getByLocale('product_page', $locale);

            if (empty($results)) {
                $data[$locale] = [
                    'title' => null,
                    'backgroundImage' => null,
                    'description' => null,
                    'seo' => [
                        'title' => null,
                        'description' => null,
                        'image' => null,
                    ],
                ];
                continue;
            }

            $data[$locale] = $results;
        }

        return $data;
    }

    public function save(array $params)
    {
        DB::transaction(function () use ($params) {
            $tmp = $params['tmp'] ??= [];
            $details = $params['details'] ??= [];

            foreach ($this->locales as $locale) {
                $details[$locale]['backgroundImage'] = $this->upload([
                    'newFile' => $tmp[$locale]['backgroundImage'] ??= null,
                    'currentPath' => $details[$locale]['backgroundImage'] ??= null,
                    'directory' => 'uploads/products/page',
                    'disk' => 'public',
                ]);

                $details[$locale]['seo']['image'] = $this->upload([
                    'newFile' => $tmp[$locale]['seo']['image'] ??= null,
                    'currentPath' => $details[$locale]['seo']['image'] ??= null,
                    'directory' => 'uploads/products/page',
                    'disk' => 'public',
                ]);

                Setting::updateOrCreate(
                    [
                        'key' => 'product_page',
                        'locale' => $locale,
                        'group' => 'catalog',
                    ],
                    [
                        'value' => $details[$locale],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }
}
