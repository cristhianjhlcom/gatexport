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
                $about['hero_image'] = $setting['hero_image'] ?? null;
                $about['home_first_image'] = $setting['home_first_image'] ?? null;
                $about['home_second_image'] = $setting['home_second_image'] ?? null;
                $about['commitment_main_image'] = $setting['commitment_main_image'] ?? null;
                $about['commitment_background_image'] = $setting['commitment_background_image'] ?? null;
                $about['quality_main_image'] = $setting['quality_main_image'] ?? null;
                $about['certification_main_image'] = $setting['certification_main_image'] ?? null;
                $about['certification_secondary_image'] = $setting['certification_secondary_image'] ?? null;
                $about['history_main_image'] = $setting['history_main_image'] ?? null;
                $about['history_background_image'] = $setting['history_background_image'] ?? null;
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
        if (! $newImage) {
            return $currentImage;
        }

        if ($currentImage && Storage::disk('public')->exists($currentImage)) {
            Storage::disk('public')->delete($currentImage);
        }

        return $newImage->store('uploads/about', 'public');
    }
}
