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
final class SettingServicesManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $newMainImage;

    #[Validate]
    public $companyServices = [
        'es' => [],
        'en' => [],
        'main_image' => '',
        'heading' => '',
        'description' => '',
        'important_message' => '',
        'disclaimer' => '',
    ];

    #[Validate]
    public $tmpIcons = [
        'es' => [],
        'en' => [],
    ];

    protected SettingManagementServices $services;

    public function boot()
    {
        $this->services = app(SettingManagementServices::class);
    }

    public function mount()
    {
        $this->companyServices = $this->services->loadCompanyServices();
    }

    public function updatedTmpIcons($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) >= 3) {
            $locale = $parts[0];
            $index = $parts[1];

            if (isset($value) && is_object($value) && method_exists($value, 'store')) {
                $this->tmpIcons[$locale][$index] = $value;
                $this->companyServices[$locale][$index]['icon'] = $value;
            }
        }
    }

    public function add($locale = 'es')
    {
        $this->companyServices[$locale][] = [
            'title' => '',
            'description' => '',
            'icon' => NULL,
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->companyServices[$locale][$index]);
        unset($this->tmpIcons[$locale][$index]);

        $this->companyServices[$locale] = array_values($this->companyServices[$locale]);
        $this->tmpIcons[$locale] = array_values($this->tmpIcons[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->saveCompanyServices([
            'company_services' => $this->companyServices,
            'new_main_image' => $this->newMainImage,
            'tmp_icons' => $this->tmpIcons,
        ]);

        Flux::toast(
            heading: 'Configuración Actualizada',
            text: 'La configuración ha sido actualizada exitosamente.',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.services')
            ->title('Company Services | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'companyServices.es.*.title' => 'required|string|max:100',
            'companyServices.es.*.description' => 'required|string|max:1000',
            'companyServices.en.*.title' => 'required|string|max:100',
            'companyServices.en.*.description' => 'required|string|max:1000',

            'newMainImage' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:2048', // 2MB max
            ],

            'tmpIcons.es.*' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
                'dimensions:min_width=400,min_height=400,max_width=1000,max_height=1000',
            ],

            'tmpIcons.en.*' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
                'dimensions:min_width=400,min_height=400,max_width=1000,max_height=1000',
            ],
        ];
    }
}
