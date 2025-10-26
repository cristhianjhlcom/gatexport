<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class CompanyServicesSettingService
{
    public array $locales = ['es', 'en'];

    public array $services = [];

    public array $cycles = [];

    public array $benefits = [];

    public function load(): array
    {
        $data = [
            'es' => [],
            'en' => [],
        ];

        foreach ($this->locales as $locale) {
            $setting = Setting::getByLocale('company_services', $locale);

            if (is_array($setting)) {
                $services = $data[$locale]['services'] ?? [];
                $data[$locale] = $setting ?? [];

                foreach ($services as $index => $service) {
                    $data[$locale]['services'][$index] = [
                        'title' => $service['title'] ?? '',
                        'subtitle' => $service['subtitle'] ?? '',
                        'description' => $service['description'] ?? '',
                        'icon' => $service['icon'] ?? NULL,
                    ];
                }
            }
        }

        return $data;
    }

    public function save(array $data)
    {
        DB::transaction(function () use ($data) {
            $keys = ['homepage', 'hero', 'cycles', 'services', 'benefits'];

            foreach ($this->locales as $locale) {
                foreach ($keys as $key) {
                    if (!empty($data['tmp_images'][$locale][$key])) {
                        if ($key === 'cycles' || $key === 'services') {
                            foreach ($data['tmp_images'][$locale][$key] as $idx => $image) {
                                if (is_object($image) && method_exists($image, 'store')) {
                                    $upload = $this->handleFileUpload($image, 'uploads/settings/services');

                                    // if (!empty($data['services_information'][$locale][$key][$idx]['image'])) {
                                    //     Storage::disk('public')->delete($data['services_information'][$locale][$key][$idx]['image']);
                                    // }

                                    $data['services_information'][$locale][$key][$idx]['image'] = $upload;
                                }
                            }
                            continue;
                        }

                        if ($key === 'benefits') {
                            foreach ($data['tmp_images'][$locale][$key] as $idx => $item) {
                                $image = $item['image'] ??= NULL;
                                $background = $item['background'] ??= NULL;
                                $isValidImage = is_object($image) && method_exists($image, 'store');
                                $isValidBackground = is_object($background) && method_exists($background, 'store');

                                if ($isValidImage && $isValidBackground) {
                                    $imageUpload = $this->handleFileUpload($image, 'uploads/settings/services');
                                    $backgroundUpload = $this->handleFileUpload($background, 'uploads/settings/services');

                                    $data['services_information'][$locale][$key][$idx]['image'] = $imageUpload;
                                    $data['services_information'][$locale][$key][$idx]['background'] = $backgroundUpload;
                                }
                            }
                            continue;
                        }

                        $upload = $this->handleFileUpload($data['tmp_images'][$locale][$key], 'uploads/settings/services');

                        // if (!empty($data['services_information'][$locale][$key]['image'])) {
                        //     Storage::disk('public')->delete($data['services_information'][$locale][$key]['image']);
                        // }

                        $data['services_information'][$locale][$key]['image'] = $upload;
                    }
                }

                Setting::updateOrCreate(
                    [
                        'key' => 'company_services',
                        'locale' => $locale,
                        'group' => 'home',
                    ],
                    [
                        'value' => [
                            'homepage' => $data['services_information'][$locale]['homepage'],
                            'hero' => $data['services_information'][$locale]['hero'],
                            'cycles' => $data['services_information'][$locale]['cycles'],
                            'services' => $data['services_information'][$locale]['services'],
                            'authority' => $data['services_information'][$locale]['authority'],
                            'benefits' => $data['services_information'][$locale]['benefits'],
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
