<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

final class SettingManagementServices
{
    private array $available_locales = ['es', 'en'];

    public function loadProviders(): array
    {
        $settings = Setting::get('providers', []);

        if (is_array($settings)) {
            foreach ($settings as $index => $provider) {
                $settings[$index]['name'] = $provider['name'] ?? '';
                $settings[$index]['image'] = $provider['image'] ?? '';
            }
        }

        return $settings;
    }

    public function loadAbout(): array
    {
        $about = [];

        foreach ($this->available_locales as $locale) {
            $about[$locale] = [
                'history' => '',
                'mission' => '',
                'vision' => '',
            ];

            $setting_about = Setting::getByLocale('about', $locale);

            if ($setting_about) {
                $about[$locale] = $setting_about['translations'] ?? $about[$locale];
                $about['first_image'] = $setting_about['first_image'] ?? '';
                $about['second_image'] = $setting_about['second_image'] ?? '';
                $about['youtube_video_id'] = $setting_about['youtube_video_id'] ?? '';
            }
        }

        return $about;
    }

    public function loadCompetitiveAdvantages(): array
    {
        $competitive_advantages = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->available_locales as $locale) {
            $setting_competitive_advantages = Setting::getByLocale('competitive_advantages', $locale);

            if (is_array($setting_competitive_advantages)) {
                foreach ($setting_competitive_advantages as $competitive_advantage) {
                    $competitive_advantages[$locale][] = [
                        'title' => $competitive_advantage['title'] ?? '',
                        'description' => $competitive_advantage['description'] ?? '',
                        'image' => $competitive_advantage['image'] ?? '', // La imagen existente se guarda como string (path)
                    ];
                }
            }
        }

        return $competitive_advantages;
    }

    public function loadCompanyServices(): array
    {
        $company_services = [
            'es' => [],
            'en' => [],
            'main_image' => '',
        ];

        foreach ($this->available_locales as $locale) {
            $setting_company_services = Setting::getByLocale('company_services', $locale);

            if (is_array($setting_company_services)) {
                $company_services[$locale] = $setting_company_services['services'] ?? [];
                $company_services['main_image'] = $setting_company_services['main_image'] ?? '';
                /*
                foreach ($setting_company_services as $company_service) {
                    $company_services[$locale][] = [
                        'title' => $company_service['title'] ?? '',
                        'description' => $company_service['description'] ?? '',
                    ];
                }
                */
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
                        'image_desktop' => $banner['image_desktop'] ?? '',
                        'image_mobile' => $banner['image_mobile'] ?? '',
                        'link_text' => $banner['link_text'] ?? '',
                        'link_url' => $banner['link_url'] ?? '',
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
            'social_media' => [
                'facebook' => '',
                'youtube' => '',
                'linkedin' => '',
            ],
            'contact_information' => [
                'address' => '',
                'phone' => '',
                'second_phone' => '',
                'whatsapp_link' => '',
                'email' => '',
            ],
            'catalog_document' => '',
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
                $general_info['social_media'] = $settings['social_media'] ?? $general_info['social_media'];
                $general_info['contact_information'] = $settings['contact_information'] ?? $general_info['contact_information'];
                $general_info['catalog_document'] = $settings['catalog_document'] ?? '';
            }
        }

        return $general_info;
    }

    public function loadHighlightedCategories(): array
    {
        $highlighted_categories = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->available_locales as $locale) {
            $settings = Setting::getByLocale('highlighted_categories', $locale);

            if ($settings) {
                $highlighted_categories[$locale] = $settings['translations'] ?? [];
            }
        }

        return $highlighted_categories;
    }

    public function saveAbout(array $data)
    {
        DB::transaction(function () use ($data) {
            if ($data['new_first_image']) {
                $data['about']['first_image'] = $this->handleFileUpload($data['new_first_image'], 'uploads/about');
            }

            if ($data['new_second_image']) {
                $data['about']['second_image'] = $this->handleFileUpload($data['new_second_image'], 'uploads/about');
            }

            foreach ($this->available_locales as $locale) {
                Setting::updateOrCreate(
                    [
                        'key' => 'about',
                        'locale' => $locale,
                        'group' => 'about',
                    ],
                    [
                        'value' => [
                            'translations' => $data['about'][$locale],
                            'first_image' => $data['about']['first_image'],
                            'second_image' => $data['about']['second_image'],
                            'youtube_video_id' => $data['about']['youtube_video_id'],
                        ],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    public function saveCompetitiveAdvantages(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->available_locales as $locale) {
                $listOfCompetitiveAdvantages = [];

                foreach ($data['competitive_advantages'][$locale] as $competitive_advantage) {
                    $image_value = $competitive_advantage['image'];

                    // Si es un nuevo archivo, lo procesamos
                    if (is_object($competitive_advantage['image']) && method_exists($competitive_advantage['image'], 'store')) {
                        $image_value = $this->handleFileUpload($competitive_advantage['image'], 'uploads/settings/competitive_advantages');
                    }

                    $listOfCompetitiveAdvantages[] = [
                        'title' => $competitive_advantage['title'],
                        'description' => $competitive_advantage['description'],
                        'image' => $image_value,
                    ];
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'competitive_advantages',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => $listOfCompetitiveAdvantages,
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    public function saveCompanyServices(array $data)
    {
        DB::transaction(function () use ($data) {
            $image_value = $data['new_main_image'];

            if (is_object($data['new_main_image']) && method_exists($data['new_main_image'], 'store')) {
                $image_value = $this->handleFileUpload($data['new_main_image'], 'uploads/settings/services');
            }

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
                        'value' => [
                            'services' => $listOfCompanyServices,
                            'main_image' => $image_value,
                        ],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    public function saveProviders(array $data)
    {
        DB::transaction(function () use ($data) {
            $listOfProviders = [];

            foreach ($data['providers'] as $provider) {
                $image_value = $provider['image'];

                // Si es un nuevo archivo, lo procesamos
                if (is_object($provider['image']) && method_exists($provider['image'], 'store')) {
                    $image_value = $this->handleFileUpload($provider['image'], 'uploads/settings/providers');
                }

                $listOfProviders[] = [
                    'name' => $provider['name'],
                    'image' => $image_value,
                ];
            }

            Setting::updateOrCreate(
                [
                    'key' => 'providers',
                    'locale' => 'es',
                    'group' => 'home',
                ],
                [
                    'value' => $listOfProviders,
                    'type' => 'json',
                    'is_public' => true,
                ]
            );
        });
    }

    public function saveBanners(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->available_locales as $locale) {
                $listOfBanners = [];

                if (isset($data['banners'][$locale])) {
                    foreach ($data['banners'][$locale] as $banner) {
                        $image_desktop_value = $banner['image_desktop'];
                        $image_mobile_value = $banner['image_mobile'];

                        if (is_object($banner['image_desktop']) && method_exists($banner['image_desktop'], 'store')) {
                            $image_desktop_value = $banner['image_desktop']->store('settings/banners/desktop', 'public');
                        }

                        if (is_object($banner['image_mobile']) && method_exists($banner['image_mobile'], 'store')) {
                            $image_mobile_value = $banner['image_mobile']->store('settings/banners/mobile', 'public');
                        }

                        $listOfBanners[] = [
                            'title' => $banner['title'],
                            'short_description' => $banner['short_description'],
                            'image_desktop' => $image_desktop_value,
                            'image_mobile' => $image_mobile_value,
                            'link_text' => $banner['link_text'],
                            'link_url' => $banner['link_url'],
                        ];
                    }
                }

                Setting::updateOrCreate(
                    ['name' => 'banners', 'locale' => $locale],
                    ['payload' => $listOfBanners]
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

            if ($data['new_catalog_document']) {
                $data['general_info']['catalog_document'] = $this->handleFileUpload($data['new_catalog_document'], 'uploads/docs');
            }

            foreach ($this->available_locales as $locale) {
                if (isset($data['tmp_highlighted_category_images'][$locale])) {
                    foreach ($data['tmp_highlighted_category_images'][$locale] as $index => $image) {
                        if (is_object($image) && method_exists($image, 'store')) {
                            $data['highlighted_categories'][$locale][$index]['image'] = $this->handleFileUpload($image, 'uploads/highlighted_categories');
                        }
                    }
                }

                $highlighted_categories = [];
                foreach ($data['highlighted_categories'][$locale] as $category) {
                    $highlighted_categories[] = [
                        'title' => $category['title'],
                        'url' => $category['url'],
                        'image' => $category['image'] ?? null,
                    ];
                }

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
                            'catalog_document' => $data['general_info']['catalog_document'],
                            'social_media' => $data['general_info']['social_media'],
                            'contact_information' => $data['general_info']['contact_information'],
                        ],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );

                Setting::updateOrCreate(
                    [
                        'key' => 'highlighted_categories',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => [
                            'translations' => $highlighted_categories,
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
