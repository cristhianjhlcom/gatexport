<?php

declare(strict_types=1);

namespace App\Services\Setting;

use App\Models\Setting;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\DB;

final class BannerManagementServices
{
    use ImageUploads;

    private array $locales = ['es', 'en'];

    public function load(): array
    {
        $banners = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->locales as $locale) {
            $results = Setting::getByLocale('banners', $locale);

            $banners[$locale] = $results;
        }

        return $banners;
    }

    public function save(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($this->locales as $locale) {
                $listOfBanners = [];

                foreach ($data['banners'][$locale] as $idx => $banner) {
                    $tmpImagesDesktop = $data['tmp_images_desktop'] ??= [];
                    $tmpImagesMobile = $data['tmp_images_mobile'] ??= [];
                    $listOfBanners[] = [
                        'title' => $banner['title'],
                        'short_description' => $banner['short_description'],
                        'image_desktop' => $this->upload([
                            'newFile' => $tmpImagesDesktop[$locale][$idx] ??= null,
                            'currentPath' => $banner['image_desktop'] ??= null,
                            'directory' => 'uploads/settings/banners/desktop',
                            'disk' => 'public',
                        ]),
                        'image_mobile' => $this->upload([
                            'newFile' => $tmpImagesMobile[$locale][$idx] ??= null,
                            'currentPath' => $banner['image_mobile'] ??= null,
                            'directory' => 'uploads/settings/banners/mobile',
                            'disk' => 'public',
                        ]),
                        'position' => $banner['position'] ??= $idx,
                        'link_text' => $banner['link_text'],
                        'link_url' => $banner['link_url'],
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
}
