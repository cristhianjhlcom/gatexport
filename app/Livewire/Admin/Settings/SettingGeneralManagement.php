<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Services\SettingManagementServices;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingGeneralManagement extends Component
{
    use WithFileUploads;

    // NOTE: Properties for temporary storage.
    #[Validate]
    public $new_large_logo;

    #[Validate]
    public $new_small_logo;

    #[Validate]
    public $new_catalog_document;

    #[Validate]
    public $new_white_logo;

    #[Validate]
    public $new_special_logo;

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
        'large_logo' => '',
        'small_logo' => '',
        'white_logo' => '',
        'special_logo' => '',
        'catalog_document' => '',
    ];

    // NOTE: Apartado para guardar categorias resaltantes en el home
    #[Validate]
    public $highlighted_categories = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmp_highlighted_category_images = [
        'es' => [],
        'en' => [],
    ];

    protected SettingManagementServices $services;

    protected $rules = [
        'general_info.es.company_name' => 'required|string|max:255',
        'general_info.es.company_short_description' => 'required|string|max:500',
        'general_info.es.company_description' => 'required|string',
        'general_info.en.company_name' => 'required|string|max:255',
        'general_info.en.company_short_description' => 'required|string|max:500',
        'general_info.en.company_description' => 'required|string',
        'general_info.social_media.facebook' => 'required|url',
        'general_info.social_media.youtube' => 'required|url',
        'general_info.social_media.linkedin' => 'required|url',
        'general_info.contact_information.address' => 'required|string|max:255',
        'general_info.contact_information.phone' => 'required|string|max:255',
        'general_info.contact_information.second_phone' => 'required|string|max:255',
        'general_info.contact_information.whatsapp_link' => 'required|url|max:255',
        'general_info.contact_information.email' => 'required|string|email|max:255',

        'new_catalog_document' => [
            'nullable',
            'file',
            'mimes:pdf',
            'max:2048', // 1MB max
        ],

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
        'new_white_logo' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,svg',
            'max:1024', // 1MB max
            'dimensions:min_width=32,min_height=32,max_width=200,max_height=200',
        ],
        'new_special_logo' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,svg',
            'max:1024', // 1MB max
            'dimensions:min_width=32,min_height=32,max_width=200,max_height=200',
        ],
        /*
        'new_favicon' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,svg',
            'max:2048', // 2MB max
            'dimensions:min_width=200,min_height=50,max_width=800,max_height=200',
        ],
        */

        'highlighted_categories.es.*.title' => 'required|string|max:255',
        'highlighted_categories.es.*.url' => 'required|url|max:255',
        // 'highlighted_categories.es.*.image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024|dimensions:min_width=100,min_height=100,max_width=500,min_height=500',
        // 'highlighted_categories.es.*.image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',

        'highlighted_categories.en.*.title' => 'required|string|max:255',
        'highlighted_categories.en.*.url' => 'required|url|max:255',
        // 'highlighted_categories.en.*.image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024|dimensions:min_width=100,min_height=100,max_width=500,min_height=500',
        // 'highlighted_categories.en.*.image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',

        // 'tmp_highlighted_category_images.es.*' => 'nullable|mimes:png,jpg,jpeg,svg,webp|max:1024|dimensions:min_width=100,min_height=100,max_width=500,min_height=500',
        'tmp_highlighted_category_images.es.*' => 'nullable|mimes:png,jpg,jpeg,svg,webp',
        // 'tmp_highlighted_category_images.en.*' => 'nullable|mimes:png,jpg,jpeg,svg,webp|max:1024|dimensions:min_width=100,min_height=100,max_width=500,min_height=500',
        'tmp_highlighted_category_images.en.*' => 'nullable|mimes:png,jpg,jpeg,svg,webp',
    ];

    protected $messages = [
        /*
        'new_favicon.dimensions' => 'El favicon debe ser entre 16x16px y 256x256px. Se recomienda 32x32px o 64x64px.',
        'new_favicon.max' => 'El favicon no debe pesar más de 512KB.',
        'new_favicon.mimes' => 'El favicon debe ser en formato ICO o PNG.',
        */

        'new_small_logo.dimensions' => 'El logo pequeño debe ser entre 32x32px y 200x200px. Se recomienda 64x64px.',
        'new_small_logo.max' => 'El logo pequeño no debe pesar más de 1MB.',
        'new_small_logo.mimes' => 'El logo debe ser en formato PNG, JPG o SVG.',

        'new_large_logo.dimensions' => 'El logo con texto debe ser entre 200x50px y 800x200px. Se recomienda 400x100px.',
        'new_large_logo.max' => 'El logo con texto no debe pesar más de 2MB.',
        'new_large_logo.mimes' => 'El logo debe ser en formato PNG, JPG o SVG.',
    ];

    public function boot()
    {
        $this->services = app(SettingManagementServices::class);
    }

    public function mount()
    {
        $this->general_info = $this->services->loadGeneralInformation();
        $this->highlighted_categories = $this->services->loadHighlightedCategories();
    }

    public function save()
    {
        $this->validate();

        $this->services->saveGeneralInformation([
            'general_info' => $this->general_info,
            'new_large_logo' => $this->new_large_logo,
            'new_small_logo' => $this->new_small_logo,
            'new_white_logo' => $this->new_white_logo,
            'new_special_logo' => $this->new_special_logo,
            'new_catalog_document' => $this->new_catalog_document,
            'highlighted_categories' => $this->highlighted_categories,
            'tmp_highlighted_category_images' => $this->tmp_highlighted_category_images,
        ]);

        Flux::toast(
            heading: 'Configuración actualizada',
            text: 'La configuración ha sido actualizada correctamente',
            variant: 'success',
        );
    }

    public function addCategory(string $locale): void
    {
        if (count($this->highlighted_categories[$locale]) >= 4) {
            Flux::toast(
                heading: 'Limite alcanzado',
                text: 'Solo puedes agregar hasta 4 categorías',
                variant: 'warning',
            );

            return;
        }

        $this->highlighted_categories[$locale][] = [
            'title' => '',
            'url' => '',
            'image' => null,
        ];
    }

    public function removeCategory(string $locale, int $index): void
    {
        if (isset($this->highlighted_categories[$locale][$index])) {
            unset($this->highlighted_categories[$locale][$index]);
            $this->highlighted_categories[$locale] = array_values($this->highlighted_categories[$locale]);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.general')
            ->with([
                'settings' => Setting::get('general_info'),
            ])
            ->title('General Information | Settings | Management');
    }
}
