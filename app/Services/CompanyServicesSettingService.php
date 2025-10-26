<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class CompanyServicesSettingService
{
    private array $locales = ['es', 'en'];

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
            $keys = ['homepage', 'hero'];

            foreach ($this->locales as $locale) {
                foreach ($keys as $key) {
                    // TODO: Verificar si la key es 'services' y recorrer la lista de servicios.
                    if (!empty($data['tmp_images'][$locale][$key])) {
                        $upload = $this->handleFileUpload($data['tmp_images'][$locale][$key], 'uploads/settings/services');

                        if (!empty($data['services_information'][$locale][$key]['image'])) {
                            Storage::disk('public')->delete($data['services_information'][$locale][$key]['image']);
                        }

                        $data['services_information'][$locale][$key]['image'] = $upload;
                    }
                }
                // if (isset($data['tmp_icons'][$locale])) {
                //     foreach ($data['tmp_icons'][$locale] as $index => $image) {
                //         if (is_object($image) && method_exists($image, 'store')) {
                //             // Eliminar el icono existente si está presente
                //             if (! empty($data['company_services'][$locale][$index]['icon'])) {
                //                 Storage::disk('public')->delete($data['company_services'][$locale][$index]['icon']);
                //             }

                //             $data['company_services'][$locale][$index]['icon'] = $this->handleFileUpload($image, 'uploads/settings/services');
                //         }
                //     }
                // }
                // $listOfCompanyServices = [];
                // foreach ($data['company_services'][$locale] as $company_service) {
                //     $listOfCompanyServices[] = [
                //         'title' => $company_service['title'],
                //         'subtitle' => $company_service['subtitle'],
                //         'description' => $company_service['description'],
                //         'icon' => $company_service['icon'],
                //     ];
                // }

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
                            // 'services' => $listOfCompanyServices,
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
