<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class SettingManagementServices
{
    protected string $current_locale = 'es';
    protected array $available_locales = ['es', 'en'];

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

    public function handleFileUpload(?UploadedFile $file, string $path): ?string
    {
        if ($file) {
            return $file->store($path, 'public');
        }

        return null;
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
}
