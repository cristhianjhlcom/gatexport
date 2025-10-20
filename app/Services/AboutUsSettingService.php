<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class AboutUsSettingService
{
    private array $availableLocales = ['es', 'en'];

    public function load()
    {
        $about = [];

        foreach ($this->availableLocales as $locale) {
            $about[$locale] = [
                'home' => [
                    'history' => '',
                ],
                'mainHistory' => '',
                'commitment' => [
                    'title' => '',
                    'description' => '',
                ],
                'quality' => [
                    'title' => '',
                    'description' => '',
                ],
                'certification' => [
                    'title' => '',
                    'description' => '',
                ],
                'ourHistory' => [
                    'title' => '',
                    'description' => '',
                ],
                'values' => [
                    'items' => [],
                    'mission' => [
                        'title' => '',
                        'description' => '',
                    ],
                    'vision' => [
                        'title' => '',
                        'description' => '',
                    ],
                ],
                'contact' => [
                    'title' => '',
                    'description' => '',
                ],
            ];

            $setting = Setting::getByLocale('about', $locale);

            if ($setting) {
                $about[$locale] = $setting['translations'] ?? $about[$locale];
                $about['youtube_video_id'] = $setting['youtube_video_id'] ?? '';
                $about['hero_image'] = $setting['hero_image'] ?? NULL;
                $about['home_first_image'] = $setting['home_first_image'] ?? NULL;
                $about['home_second_image'] = $setting['home_second_image'] ?? NULL;
                $about['commitment_main_image'] = $setting['commitment_main_image'] ?? NULL;
                $about['commitment_background_image'] = $setting['commitment_background_image'] ?? NULL;
                $about['quality_main_image'] = $setting['quality_main_image'] ?? NULL;
                $about['certification_main_image'] = $setting['certification_main_image'] ?? NULL;
                $about['certification_secondary_image'] = $setting['certification_secondary_image'] ?? NULL;
                $about['history_main_image'] = $setting['history_main_image'] ?? NULL;
                $about['history_background_image'] = $setting['history_background_image'] ?? NULL;
            }
        }

        return $about;
    }

    public function save(array $data)
    {
        DB::transaction(function () use ($data) {
            $data['about']['hero_image'] = $this->handleFileUpload($data['new_hero_image'], $data['about']['hero_image']);
            $data['about']['home_first_image'] = $this->handleFileUpload($data['new_home_first_image'], $data['about']['home_first_image']);
            $data['about']['home_second_image'] = $this->handleFileUpload($data['new_home_second_image'], $data['about']['home_second_image']);
            $data['about']['commitment_main_image'] = $this->handleFileUpload($data['new_commitment_main_image'], $data['about']['commitment_main_image']);
            $data['about']['commitment_background_image'] = $this->handleFileUpload($data['new_commitment_background_image'], $data['about']['commitment_background_image']);
            $data['about']['quality_main_image'] = $this->handleFileUpload($data['new_quality_main_image'], $data['about']['quality_main_image']);
            $data['about']['certification_main_image'] = $this->handleFileUpload($data['new_certification_main_image'], $data['about']['certification_main_image']);
            $data['about']['certification_secondary_image'] = $this->handleFileUpload($data['new_certification_secondary_image'], $data['about']['certification_secondary_image']);
            $data['about']['history_main_image'] = $this->handleFileUpload($data['new_history_main_image'], $data['about']['history_main_image']);
            $data['about']['history_background_image'] = $this->handleFileUpload($data['new_history_background_image'], $data['about']['history_background_image']);

            foreach ($this->availableLocales as $locale) {
                if (isset($data['about']['values']) && isset($data['about']['values']['items'])) {
                    foreach ($data['new_values_icons'] as $idx => $icon) {
                        $currentValueItem = $data['about']['values']['items'][$idx];
                        $tempValueIcon = $data['new_values_icons'][$idx];
                        $currentValueItem['image'] = $this->handleFileUpload($tempValueIcon[$locale], $currentValueItem['image']);
                    }
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'about',
                        'locale' => $locale,
                        'group' => 'about',
                    ],
                    [
                        'value' => [
                            'translations' => $data['about'][$locale],
                            'youtube_video_id' => $data['youtube_video_id'],
                            'hero_image' => $data['about']['hero_image'],
                            'home_first_image' => $data['about']['home_first_image'],
                            'home_second_image' => $data['about']['home_second_image'],
                            'commitment_main_image' => $data['about']['commitment_main_image'],
                            'commitment_background_image' => $data['about']['commitment_background_image'],
                            'quality_main_image' => $data['about']['quality_main_image'],
                            'certification_main_image' => $data['about']['certification_main_image'],
                            'certification_secondary_image' => $data['about']['certification_secondary_image'],
                            'history_main_image' => $data['about']['history_main_image'],
                            'history_background_image' => $data['about']['history_background_image'],
                        ],
                        'type' => 'json',
                        'is_public' => true,
                    ]
                );
            }
        });
    }

    private function handleFileUpload(?UploadedFile $newImage, ?string $currentImage): ?string
    {
        if (!$newImage) return $currentImage;

        if ($currentImage && Storage::disk('public')->exists($currentImage)) {
            Storage::disk('public')->delete($currentImage);
        }

        return $newImage->store('uploads/about', 'public');
    }
}
