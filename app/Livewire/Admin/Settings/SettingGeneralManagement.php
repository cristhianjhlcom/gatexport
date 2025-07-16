<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Create Sub Category')]
final class SettingGeneralManagement extends Component
{
    use WithFileUploads;

    public string $current_locale = 'es';
    public array $available_locales = ['es', 'en'];

    // NOTE: Properties for temporary storage.
    #[Validate]
    public $new_large_logo;

    #[Validate]
    public $new_small_logo;

    #[Validate]
    public $new_favicon;

    // NOTE: Properties for other settings.
    #[Validate]
    public $general_info = [
        'es' => [
            'company_name' => '',
            'company_short_description' => '',
            'company_description' => '',
        ],
        'en' => [
            'company_name' => '',
            'company_short_description' => '',
            'company_description' => '',
        ],
        'large_logo' => '',
        'small_logo' => '',
        'favicon' => '',
    ];

    protected $rules = [
        'general_info.es.company_name' => 'required|string|max:255',
        'general_info.es.company_short_description' => 'required|string|max:500',
        'general_info.es.company_description' => 'required|string',
        'general_info.en.company_name' => 'required|string|max:255',
        'general_info.en.company_short_description' => 'required|string|max:500',
        'general_info.en.company_description' => 'required|string',
        'new_large_logo' => [
            'nullable',
            'image',
            'mimes:ico,png',
            'max:512', // 512KB max
            'dimensions:min_width=16,min_height=16,max_width=256,max_height=256',
        ],
        'new_small_logo' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,svg',
            'max:1024', // 1MB max
            'dimensions:min_width=32,min_height=32,max_width=200,max_height=200',
        ],
        'new_favicon' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,svg',
            'max:2048', // 2MB max
            'dimensions:min_width=200,min_height=50,max_width=800,max_height=200',
        ],
    ];

    public function mount()
    {
        $this->loadSettings();
    }

    public function save()
    {
        $this->validate();

        // NOTE: Handle File Uploads.
        if ($this->new_large_logo) {
            $this->general_info['large_logo'] = $this->handleFileUpload($this->new_large_logo, 'uploads/settings/logos');
        }

        if ($this->new_small_logo) {
            $this->general_info['small_logo'] = $this->handleFileUpload($this->new_small_logo, 'uploads/settings/logos');
        }

        if ($this->new_favicon) {
            $this->general_info['favicon'] = $this->handleFileUpload($this->new_favicon, 'uploads/settings/logos');
        }

        // NOTE: Handle Other Settings.
        foreach ($this->available_locales as $locale) {
            Setting::updateOrCreate(
                [
                    'key' => 'general_info',
                    'locale' => $locale,
                    'group' => 'general',
                ],
                [
                    'value' => [
                        'translations' => $this->general_info[$locale],
                        'large_logo' => $this->general_info['large_logo'],
                        'small_logo' => $this->general_info['small_logo'],
                        'favicon' => $this->general_info['favicon'],
                    ],
                    'type' => 'json',
                    'is_public' => true,
                ]
            );
        }

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.general')
            ->with([
                'settings' => Setting::get('general_info'),
            ])
            ->title('General Information | Management');
    }

    protected $messages = [
        'new_favicon.dimensions' => 'El favicon debe ser entre 16x16px y 256x256px. Se recomienda 32x32px o 64x64px.',
        'new_favicon.max' => 'El favicon no debe pesar más de 512KB.',
        'new_favicon.mimes' => 'El favicon debe ser en formato ICO o PNG.',

        'new_small_logo.dimensions' => 'El logo pequeño debe ser entre 32x32px y 200x200px. Se recomienda 64x64px.',
        'new_small_logo.max' => 'El logo pequeño no debe pesar más de 1MB.',
        'new_small_logo.mimes' => 'El logo debe ser en formato PNG, JPG o SVG.',

        'new_large_logo.dimensions' => 'El logo con texto debe ser entre 200x50px y 800x200px. Se recomienda 400x100px.',
        'new_large_logo.max' => 'El logo con texto no debe pesar más de 2MB.',
        'new_large_logo.mimes' => 'El logo debe ser en formato PNG, JPG o SVG.',
    ];

    protected function handleFileUpload($file, $path)
    {
        if ($file) {
            return $file->store($path, 'public');
        }

        return null;
    }

    protected function loadSettings()
    {
        foreach ($this->available_locales as $locale) {
            // NOTE: Load General Info.
            $general_info = Setting::getByLocale('general_info', $locale);

            if ($general_info) {
                $this->general_info[$locale] = $general_info['translations'] ?? [
                    'company_name' => '',
                    'company_short_description' => '',
                    'company_description' => '',
                ];

                $this->general_info['large_logo'] = $general_info['large_logo'] ?? '';
                $this->general_info['small_logo'] = $general_info['small_logo'] ?? '';
                $this->general_info['favicon'] = $general_info['favicon'] ?? '';
            }
        }
    }
}
