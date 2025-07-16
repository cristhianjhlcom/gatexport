<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\SettingManagementServices;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
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
    public $tmp_images = [
        'es' => [],
        'en' => [],
    ];

    protected SettingManagementServices $services;

    protected $messages = [
        'banners.*.*.image.dimensions' => 'La imagen debe tener un tamaño entre 1200x600px y 2560x1440px.',
        'banners.*.*.image.max' => 'La imagen no debe pesar más de 2MB.',
        'banners.*.*.image.mimes' => 'La imagen debe estar en formato JPG, PNG o WebP.',
    ];

    public function boot()
    {
        $this->services = app(SettingManagementServices::class);
    }

    public function mount()
    {
        $this->banners = $this->services->loadBanners();
    }

    public function updatedTmpImages($value, $key)
    {
        Log::info('updatedTmpImages', [
            'value' => $value,
            'key' => $key,
        ]);

        $parts = explode('.', $key);

        if (count($parts) >= 3) {
            $locale = $parts[0];
            $index = $parts[1];

            if (isset($value)) {
                $this->tmp_images[$locale][$index] = $value;
                $this->banners[$locale][$index]['image'] = $value;
            }
        }
    }

    public function add($locale = 'es')
    {
        $this->banners[$locale][] = [
            'title' => '',
            'short_description' => '',
            'image' => '',
            'link_text' => '',
            'link_url' => '',
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->banners[$locale][$index]);
        unset($this->tmp_images[$locale][$index]);

        $this->banners[$locale] = array_values($this->banners[$locale]);
        $this->tmp_images[$locale] = array_values($this->tmp_images[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->saveBanners([
            'banners' => $this->banners,
        ]);

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.banners')
            ->title('Banners | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'banners.*.*.title' => 'required|string|max:255',
            'banners.*.*.short_description' => 'required|string|max:500',
            'banners.*.*.image' => 'required',
            'banners.*.*.link_text' => 'nullable|string|max:50',
            'banners.*.*.link_url' => 'nullable|string|max:255',
            'tmp_images.*.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=1200,min_height=600,max_width=2560,max_height=1440',
            ],
        ];
    }
}
