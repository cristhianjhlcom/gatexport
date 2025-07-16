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

    public string $currentLocale = 'en';
    public array $availableLocales = ['en', 'es'];

    public $exportCountriesList = [
        ['code' => 'PE', 'name' => 'Peru'],
        ['code' => 'AR', 'name' => 'Argentina'],
        ['code' => 'CL', 'name' => 'Chile'],
        ['code' => 'CO', 'name' => 'Colombia'],
        ['code' => 'EC', 'name' => 'Ecuador'],
        ['code' => 'VE', 'name' => 'Venezuela'],
        ['code' => 'PY', 'name' => 'Paraguay'],
        ['code' => 'BO', 'name' => 'Bolivia'],
        ['code' => 'SR', 'name' => 'Suriname'],
        ['code' => 'UY', 'name' => 'Uruguay'],
        ['code' => 'GY', 'name' => 'Guyana'],
        ['code' => 'PY', 'name' => 'Paraguay'],
        ['code' => 'PA', 'name' => 'Panama'],
        ['code' => 'IN', 'name' => 'India'],
        ['code' => 'AE', 'name' => 'United Arab Emirates'],
        ['code' => 'SA', 'name' => 'Saudi Arabia'],
        ['code' => 'OM', 'name' => 'Oman'],
        ['code' => 'KW', 'name' => 'Kuwait'],
        ['code' => 'QA', 'name' => 'Qatar'],
        ['code' => 'BH', 'name' => 'Bahrain'],
        ['code' => 'EG', 'name' => 'Egypt'],
        ['code' => 'MA', 'name' => 'Morocco'],
        ['code' => 'TR', 'name' => 'Turkey'],
        ['code' => 'ID', 'name' => 'Indonesia'],
        ['code' => 'MY', 'name' => 'Malaysia'],
        ['code' => 'SG', 'name' => 'Singapore'],
        ['code' => 'TH', 'name' => 'Thailand'],
        ['code' => 'JP', 'name' => 'Japan'],
        ['code' => 'KR', 'name' => 'South Korea'],
        ['code' => 'US', 'name' => 'United States'],
        ['code' => 'GB', 'name' => 'United Kingdom'],
        ['code' => 'FR', 'name' => 'France'],
        ['code' => 'DE', 'name' => 'Germany'],
        ['code' => 'IT', 'name' => 'Italy'],
        ['code' => 'ES', 'name' => 'Spain'],
        ['code' => 'NL', 'name' => 'Netherlands'],
        ['code' => 'BE', 'name' => 'Belgium'],
        ['code' => 'CH', 'name' => 'Switzerland'],
        ['code' => 'AU', 'name' => 'Australia'],
        ['code' => 'NZ', 'name' => 'New Zealand'],
        ['code' => 'BR', 'name' => 'Brazil'],
        ['code' => 'MX', 'name' => 'Mexico'],
        ['code' => 'CA', 'name' => 'Canada'],
    ];

    // NOTE: Properties for temporary storage.
    #[Validate]
    public $newLargeLogo;

    #[Validate]
    public $newSmallLogo;

    #[Validate]
    public $newFavicon;

    #[Validate]
    public $newAboutImage;

    // NOTE: Properties for other settings.
    #[Validate]
    public $generalInfo = [
        'en' => [
            'company_name' => '',
            'company_short_description' => '',
            'company_description' => '',
        ],
        'es' => [
            'company_name' => '',
            'company_short_description' => '',
            'company_description' => '',
        ],
        'large_logo' => '',
        'small_logo' => '',
        'favicon' => '',
    ];

    #[Validate]
    public $aboutUs = [
        'en' => [
            'history' => '',
            'vision' => '',
            'mission' => '',
        ],
        'es' => [
            'history' => '',
            'vision' => '',
            'mission' => '',
        ],
        'main_image' => '',
    ];

    #[Validate]
    public $exportCountries;

    #[Validate]
    public $contactInfo;

    #[Validate]
    public array $addresses = [];

    #[Validate]
    public array $phones = [];

    #[Validate]
    public array $emails = [];

    #[Validate]
    public $banners = [
        'en' => [],
        'es' => []
    ];

    #[Validate]
    public $providers = [
        'en' => [],
        'es' => []
    ];

    #[Validate]
    public array $socialMedias = [];

    protected $rules = [
        'generalInfo.*.company_name' => 'required|string|max:255',
        'generalInfo.*.company_short_description' => 'required|string|max:500',
        'generalInfo.*.company_description' => 'required|string',
        'newLargeLogo' => 'nullable|image|max:1024',
        'newSmallLogo' => 'nullable|image|max:1024',
        'newFavicon' => 'nullable|image|max:1024',

        'banners.*.*.title' => 'required|string|max:255',
        'banners.*.*.short_description' => 'required|string',
        'banners.*.*.image' => 'required|image|max:1024',
        'banners.*.*.link_text' => 'nullable|string',

        'providers.*.*.title' => 'required|string|max:255',
        'providers.*.*.image' => 'nullable|image|max:1024',

        'aboutUs.*.history' => 'required|string',
        'aboutUs.*.vision' => 'required|string',
        'aboutUs.*.mission' => 'required|string',
        'newAboutImage' => 'nullable|image|max:1024',

        'exportCountries.countries' => 'nullable|array',
        'exportCountries.countries.*' => 'nullable|string',

        'contactInfo.phones' => 'nullable|array',
        'contactInfo.phones.*' => 'nullable|string',
        'contactInfo.emails' => 'nullable|array',
        'contactInfo.emails.*' => 'nullable|email',
        'contactInfo.addresses' => 'nullable|array',
        'contactInfo.addresses.*' => 'nullable|string',
        'contactInfo.social_medias' => 'nullable|array',
        'contactInfo.social_medias.*.icon' => 'nullable|image|max:1024',
        'contactInfo.social_medias.*.link' => 'nullable|url',
        'contactInfo.social_medias.*.name' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->loadSettings();
    }

    // NOTE: Handle Banners.
    public function addBanner($locale = null)
    {
        Log::info('addBanner', [
            'locale' => $locale,
            'banners' => $this->banners[$locale],
        ]);
        $locale = $locale ?? $this->currentLocale;
        $this->banners[$locale][] = [
            'title' => '',
            'short_description' => '',
            'link_url' => '',
            'link_text' => '',
        ];
    }

    public function removeBanner($locale, $index)
    {
        unset($this->banners[$locale][$index]);
        $this->banners[$locale] = array_values($this->banners[$locale]);
    }

    // NOTE: Handle Providers.
    public function addProvider($locale = null)
    {
        $locale = $locale ?? $this->currentLocale;
        $this->providers[$locale][] = [
            'title' => '',
            'image' => '',
        ];
    }

    public function removeProvider($locale, $index)
    {
        unset($this->providers[$locale][$index]);
        $this->providers[$locale] = array_values($this->providers[$locale]);
    }

    // NOTE: Handle Phones.
    public function addPhone()
    {
        $this->phones[] = '';
    }

    public function removePhone($index)
    {
        unset($this->phones[$index]);
    }

    // NOTE: Handle Emails.
    public function addEmail()
    {
        $this->emails[] = '';
    }

    public function removeEmail($index)
    {
        unset($this->emails[$index]);
    }

    // NOTE: Handle Addresses.
    public function addAddress()
    {
        $this->addresses[] = '';
    }

    public function removeAddress($index)
    {
        unset($this->addresses[$index]);
    }

    // NOTE: Handle Social Medias.
    public function addSocialMedia()
    {
        $this->socialMedias[] = [
            'icon' => null,
            'link' => '',
            'name' => '',
        ];
    }

    public function removeSocialMedia($index)
    {
        unset($this->socialMedias[$index]);
    }

    public function save()
    {
        $this->validate();

        // NOTE: Handle File Uploads.
        if ($this->newLargeLogo) {
            $this->generalInfo['large_logo'] = $this->handleFileUpload($this->newLargeLogo, 'uploads/settings/logos');
        }
        if ($this->newSmallLogo) {
            $this->generalInfo['small_logo'] = $this->handleFileUpload($this->newSmallLogo, 'uploads/settings/logos');
        }
        if ($this->newFavicon) {
            $this->generalInfo['favicon'] = $this->handleFileUpload($this->newFavicon, 'uploads/settings/logos');
        }
        if ($this->newAboutImage) {
            $this->aboutUs['main_image'] = $this->handleFileUpload($this->newAboutImage, 'uploads/settings/about');
        }

        foreach ($this->socialMedias as $index => $socialMedia) {
            if ($socialMedia['icon']) {
                $this->socialMedias[$index]['icon'] = $this->handleFileUpload($socialMedia['icon'], 'uploads/settings/social_media');
            }
        }

        // NOTE: Handle Other Settings.
        foreach ($this->availableLocales as $locale) {
            $settings = [
                [
                    'key' => 'general_info',
                    'value' => [
                        'translations' => $this->generalInfo[$locale],
                        'large_logo' => $this->generalInfo['large_logo'],
                        'small_logo' => $this->generalInfo['small_logo'],
                        'favicon' => $this->generalInfo['favicon'],
                    ],
                    'group' => 'general',
                    'type' => 'json',
                    'is_public' => true,
                    'locale' => $locale,
                ],
                [
                    'key' => 'banners',
                    'value' => $this->banners[$locale],
                    'group' => 'home',
                    'type' => 'json',
                    'is_public' => true,
                    'locale' => $locale,
                ],
                [
                    'key' => 'providers',
                    'value' => $this->providers[$locale],
                    'group' => 'home',
                    'type' => 'json',
                    'is_public' => true,
                    'locale' => $locale,
                ],
                [
                    'key' => 'about_us',
                    'value' => [
                        'translations' => $this->aboutUs[$locale],
                        'main_image' => $this->aboutUs['main_image'],
                    ],
                    'group' => 'about',
                    'type' => 'json',
                    'is_public' => true,
                    'locale' => $locale,
                ],
                [
                    'key' => 'export_countries',
                    'value' => $this->exportCountries,
                    'group' => 'exports',
                    'type' => 'json',
                    'is_public' => true,
                ],
                [
                    'key' => 'contact_info',
                    'value' => $this->contactInfo,
                    'group' => 'contact',
                    'type' => 'json',
                    'is_public' => true,
                ],
            ];

            foreach ($settings as $setting) {
                Setting::updateOrCreate(
                    ['key' => $setting['key'], 'locale' => $locale],
                    $setting
                );
            }
        }

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.index')->with([
            'settings' => Setting::getAllGrouped(),
        ]);
    }

    protected function handleFileUpload($file, $path)
    {
        if ($file) {
            return $file->store($path, 'public');
        }

        return null;
    }

    protected function loadSettings()
    {
        foreach ($this->availableLocales as $locale) {
            // NOTE: Load General Info.
            $generalInfo = Setting::getByLocale('general_info', $locale);
            if ($generalInfo) {
                $this->generalInfo[$locale] = $generalInfo['translations'] ?? [
                    'company_name' => '',
                    'company_short_description' => '',
                    'company_description' => '',
                ];
                // Cargar logos solo una vez
                if ($locale === 'en') {
                    $this->generalInfo['large_logo'] = $generalInfo['large_logo'] ?? '';
                    $this->generalInfo['small_logo'] = $generalInfo['small_logo'] ?? '';
                    $this->generalInfo['favicon'] = $generalInfo['favicon'] ?? '';
                }
            }


            // NOTE: Load Banners.
            $this->banners[$locale] = Setting::getByLocale('banners', $locale) ?? [];

            // NOTE: Load Providers.
            $this->providers[$locale] = Setting::getByLocale('providers', $locale) ?? [];

            // NOTE: Load About Us.
            $aboutUs = Setting::getByLocale('about_us', $locale);
            if ($aboutUs) {
                $this->aboutUs[$locale] = $aboutUs['translations'] ?? [
                    'history' => '',
                    'vision' => '',
                    'mission' => '',
                ];
                if ($locale === 'en') {
                    $this->aboutUs['main_image'] = $aboutUs['main_image'] ?? '';
                }
            }

            // NOTE: Load Export Countries.
            $this->exportCountries = Setting::get('export_countries') ?? [
                'countries' => [],
            ];

            // NOTE: Load Contact Info.
            $this->contactInfo = Setting::get('contact_info') ?? [
                'phones' => [],
                'emails' => [],
                'addresses' => [],
                'social_medias' => [],
            ];
        }
    }
}
