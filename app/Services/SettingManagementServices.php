<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

final class SettingManagementServices
{
    private array $available_locales = ['es', 'en'];

    public function loadCompanyServices(): array
    {
        $company_services = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->available_locales as $locale) {
            $setting_company_services = Setting::getByLocale('company_services', $locale);

            if (is_array($setting_company_services)) {
                foreach ($setting_company_services as $company_service) {
                    $company_services[$locale][] = [
                        'title' => $company_service['title'] ?? '',
                        'description' => $company_service['description'] ?? '',
                    ];
                }
            }
        }

        return $company_services;
    }

    public function loadBanners(): array
    {
        $banners = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->available_locales as $locale) {
            $setting_banners = Setting::getByLocale('banners', $locale);

            if (is_array($setting_banners)) {
                foreach ($setting_banners as $banner) {
                    $banners[$locale][] = [
                        'title' => $banner['title'] ?? '',
                        'short_description' => $banner['short_description'] ?? '',
                        'link_text' => $banner['link_text'] ?? '',
                        'link_url' => $banner['link_url'] ?? '',
                        'image' => $banner['image'] ?? '', // La imagen existente se guarda como string (path)
                    ];
                }
            }
        }

        return $banners;
    }

    public function loadGeneralInformation(): array
    {
        $general_info = [
            'large_logo' => '',
            'small_logo' => '',
        ];

        foreach ($this->available_locales as $locale) {
            $general_info[$locale] = [
                'company_name' => '',
                'company_short_description' => '',
                'company_description' => '',
            ];

            $settings = Setting::getByLocale('general_info', $locale);

            if ($settings) {
                $general_info[$locale] = $settings['translations'] ?? $general_info[$locale];
                $general_info['large_logo'] = $settings['large_logo'] ?? '';
                $general_info['small_logo'] = $settings['small_logo'] ?? '';
            }
        }

        return $general_info;
    }

    public function saveCompanyServices(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->available_locales as $locale) {
                $listOfCompanyServices = [];

                foreach ($data['company_services'][$locale] as $company_service) {
                    $listOfCompanyServices[] = [
                        'title' => $company_service['title'],
                        'description' => $company_service['description'],
                    ];
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'company_services',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => $listOfCompanyServices,
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    public function saveBanners(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->available_locales as $locale) {
                $listOfBanners = [];

                foreach ($data['banners'][$locale] as $banner) {
                    $image_value = $banner['image'];

                    // Si es un nuevo archivo, lo procesamos
                    if (is_object($banner['image']) && method_exists($banner['image'], 'store')) {
                        $image_value = $this->handleFileUpload($banner['image'], 'uploads/settings/banners');
                    }

                    $listOfBanners[] = [
                        'title' => $banner['title'],
                        'short_description' => $banner['short_description'],
                        'link_text' => $banner['link_text'] ?? '',
                        'link_url' => $banner['link_url'] ?? '',
                        'image' => $image_value,
                    ];
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'banners',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => $listOfBanners,
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    public function saveGeneralInformation(array $data)
    {
        DB::transaction(function () use ($data) {
            if ($data['new_large_logo']) {
                $data['general_info']['large_logo'] = $this->handleFileUpload($data['new_large_logo'], 'uploads/settings/logos');
            }

            if ($data['new_small_logo']) {
                $data['general_info']['small_logo'] = $this->handleFileUpload($data['new_small_logo'], 'uploads/settings/logos');
            }

            foreach ($this->available_locales as $locale) {
                Setting::updateOrCreate(
                    [
                        'key' => 'general_info',
                        'locale' => $locale,
                        'group' => 'general',
                    ],
                    [
                        'value' => [
                            'translations' => $data['general_info'][$locale],
                            'large_logo' => $data['general_info']['large_logo'],
                            'small_logo' => $data['general_info']['small_logo'],
                        ],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    private function handleFileUpload(?UploadedFile $file, string $path): ?string
    {
        if ($file) {
            return $file->store($path, 'public');
        }

        return null;
    }
}
