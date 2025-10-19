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
                'mission' => '',
                'vision' => '',
            ];

            $setting = Setting::getByLocale('about', $locale);

            if ($setting) {
                $about[$locale] = $setting['translations'] ?? $about[$locale];
                $about['hero_image'] = $setting['hero_image'] ?? NULL;
                $about['home_first_image'] = $setting['home_first_image'] ?? NULL;
                $about['home_second_image'] = $setting['home_second_image'] ?? NULL;
                $about['youtube_video_id'] = $setting['youtube_video_id'] ?? NULL;
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
                            'hero_image' => $data['about']['hero_image'],
                            'home_first_image' => $data['about']['home_first_image'],
                            'home_second_image' => $data['about']['home_second_image'],
                            'youtube_video_id' => $data['about']['youtube_video_id'],
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
