<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\Setting\BannerManagementService;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingBannersManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $banners = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmp_images_desktop = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmp_images_mobile = [
        'es' => [],
        'en' => [],
    ];

    protected BannerManagementService $services;

    protected $messages = [
        'tmp_images_desktop.*.*.dimensions' => 'La imagen de escritorio debe tener un tamaño entre 1200x600px y 2560x1440px.',
        'tmp_images_desktop.*.*.max' => 'La imagen de escritorio no debe pesar más de 2MB.',
        'tmp_images_desktop.*.*.mimes' => 'La imagen de escritorio debe estar en formato JPG, PNG o WebP.',
        'tmp_images_mobile.*.*.dimensions' => 'La imagen móvil debe tener un tamaño entre 600x800px y 1080x1920px.',
        'tmp_images_mobile.*.*.max' => 'La imagen móvil no debe pesar más de 2MB.',
        'tmp_images_mobile.*.*.mimes' => 'La imagen móvil debe estar en formato JPG, PNG o WebP.',
    ];

    public function boot()
    {
        $this->services = app(BannerManagementService::class);
    }

    public function mount()
    {
        $this->banners = $this->services->load();
    }

    public function updatedTmpImagesDesktop($value, $key)
    {
        $parts = explode('.', $key);
        $locale = $parts[0];
        $index = $parts[1];

        if (isset($this->banners[$locale][$index])) {
            $this->banners[$locale][$index]['image_desktop'] = $value;
        }
    }

    public function updatedTmpImagesMobile($value, $key)
    {
        $parts = explode('.', $key);
        $locale = $parts[0];
        $index = $parts[1];

        if (isset($this->banners[$locale][$index])) {
            $this->banners[$locale][$index]['image_mobile'] = $value;
        }
    }

    public function add($locale = 'es')
    {
        $this->banners[$locale][] = [
            'title' => '',
            'short_description' => '',
            'image_desktop' => '',
            'image_mobile' => '',
            'link_text' => '',
            'link_url' => '',
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->banners[$locale][$index]);
        unset($this->tmp_images_desktop[$locale][$index]);
        unset($this->tmp_images_mobile[$locale][$index]);

        $this->banners[$locale] = array_values($this->banners[$locale]);
        $this->tmp_images_desktop[$locale] = array_values($this->tmp_images_desktop[$locale]);
        $this->tmp_images_mobile[$locale] = array_values($this->tmp_images_mobile[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->save([
            'banners' => $this->banners,
            'tmp_images_desktop' => $this->tmp_images_desktop,
            'tmp_images_mobile' => $this->tmp_images_mobile,
        ]);

        Flux::toast(
            heading: 'Configuración Guardada',
            text: 'Cambios en los banners guardados exitosamente.',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.banners.index')
            ->title('Banners | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'banners.*.*.title' => 'required|string|max:1000',
            'banners.*.*.short_description' => 'nullable|string|max:1000',
            'banners.*.*.image_desktop' => 'required',
            'banners.*.*.image_mobile' => 'required',
            'banners.*.*.link_text' => 'nullable|string|max:50',
            'banners.*.*.link_url' => 'required|string|max:255',
            'tmp_images_desktop.*.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=1200,min_height=600,max_width=2560,max_height=1440',
            ],
            'tmp_images_mobile.*.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=600,min_height=800,max_width=1080,max_height=1920',
            ],
        ];
    }
}
