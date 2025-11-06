<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\Setting\CountryManagementService;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingCountriesManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $continents = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmpImages = [
        'es' => [],
        'en' => [],
    ];

    protected CountryManagementService $services;

    public function boot()
    {
        $this->services = app(CountryManagementService::class);
    }

    public function mount()
    {
        $this->continents = $this->services->load();
    }

    public function add($locale = 'es')
    {
        $this->continents[$locale][] = [
            'title' => '',
            'image' => '',
            'position' => count($this->continents[$locale]) + 1,
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->continents[$locale][$index]);
        unset($this->tmpImages[$locale][$index]);

        $this->continents[$locale] = array_values($this->continents[$locale]);
        $this->tmpImages[$locale] = array_values($this->tmpImages[$locale]);
    }

    public function save()
    {
        $this->services->save([
            'continents' => $this->continents,
            'tmpImages' => $this->tmpImages,
        ]);

        Flux::toast(
            heading: 'Configuración actualizada',
            text: 'La configuración ha sido actualizada correctamente',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.countries.index')
            ->title('Paises de Exportación | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'continents.*.*.title' => 'required|string|max:1000',
            'continents.*.*.image' => 'required',
            'tmpImages.*.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1024',
                'dimensions:width=1000,height=600',
            ],
        ];
    }
}
