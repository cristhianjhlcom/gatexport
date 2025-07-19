<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\SettingManagementServices;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingProvidersManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $providers = [];

    #[Validate]
    public $tmp_images = [];

    protected SettingManagementServices $services;

    protected $messages = [
        'banners.*.*.image.dimensions' => 'La imagen debe tener un tamaño entre 500x500px y 1000x1000px.',
        'banners.*.*.image.max' => 'La imagen no debe pesar más de 2MB.',
        'banners.*.*.image.mimes' => 'La imagen debe estar en formato JPG, PNG o WebP.',
    ];

    public function boot()
    {
        $this->services = app(SettingManagementServices::class);
    }

    public function mount()
    {
        $this->providers = $this->services->loadProviders();
    }

    public function updatedTmpImages($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) >= 3) {
            $index = $parts[0];

            if (isset($value)) {
                $this->tmp_images[$index] = $value;
                $this->providers[$index]['image'] = $value;
            }
        }
    }

    public function add()
    {
        $this->providers[] = [
            'name' => '',
            'image' => '',
        ];
    }

    public function remove($index)
    {
        unset($this->providers[$index]);
        unset($this->tmp_images[$index]);

        $this->providers = array_values($this->providers);
        $this->tmp_images = array_values($this->tmp_images);
    }

    public function save()
    {
        $this->validate();

        $this->services->saveProviders([
            'providers' => $this->providers,
        ]);

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.providers')
            ->title('providers | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'providers.*.name' => 'required|string|max:90',
            'providers.*.image' => 'required',

            'tmp_images.*.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=500,min_height=500,max_width=1000,max_height=1000',
            ],
        ];
    }
}
