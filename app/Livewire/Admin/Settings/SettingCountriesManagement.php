<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\ExportCountriesSettingService;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]
final class SettingCountriesManagement extends Component
{
    // #[Validate]
    public $exports = [];

    public $continents = [];

    protected ExportCountriesSettingService $services;

    public function boot()
    {
        $this->services = app(ExportCountriesSettingService::class);
    }

    public function mount()
    {
        $this->continents = $this->services->load();

        foreach ($this->continents as $continent) {
            foreach ($continent['countries'] as $country) {
                $country['export'] = (bool) ($country['export'] ?? false);
            }
        }
    }

    public function save()
    {
        $this->services->save($this->continents);

        Flux::toast(
            heading: 'Configuración actualizada',
            text: 'La configuración ha sido actualizada correctamente',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.countries')
            ->with([
                'continents' => $this->continents,
            ])
            ->title('Paises de Exportación | Settings | Management');
    }
}
