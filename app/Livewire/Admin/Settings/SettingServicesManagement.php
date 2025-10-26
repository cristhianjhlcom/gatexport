<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\CompanyServicesSettingService;
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
    public $data = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmpImages = [
        'es' => [],
        'en' => [],
    ];

    protected CompanyServicesSettingService $services;

    public function boot()
    {
        $this->services = app(CompanyServicesSettingService::class);
    }

    public function mount()
    {
        $this->data = $this->services->load();
    }

    public function updatedTmpImages($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) == 2) {
            $locale = $parts[0];
            $idx = $parts[1];

            if (isset($value) && is_object($value) && method_exists($value, 'store')) {
                $this->tmpImages[$locale][$idx] = $value;
                $this->data[$locale][$idx]['image'] = $value;
            }
        }

        if (count($parts) == 3) {
            $locale = $parts[0];
            $item = $parts[1];
            $idx = $parts[2];

            if (isset($value) && is_object($value) && method_exists($value, 'store')) {
                $this->tmpImages[$locale][$item][$idx] = $value;
                $this->data[$locale][$item][$idx]['image'] = $value;
            }
        }
    }

    public function addService($locale = 'es')
    {
        $count = $this->data[$locale]['cycles'] ??= [];

        $this->data[$locale]['services'][] = [
            'title' => '',
            'subtitle' => '',
            'description' => '',
            'order' => count($count) + 1,
            'image' => NULL,
        ];
    }

    public function removeService($locale, $idx)
    {
        unset($this->data[$locale]['services'][$idx]);
        unset($this->tmpImages[$locale]['services'][$idx]);

        $this->data[$locale]['services'] = array_values($this->data[$locale]['services']);
        $this->tmpImages[$locale]['services'] = array_values($this->tmpImages[$locale]['services']);
    }

    public function addCycle($locale = 'es')
    {
        try {
            $count = $this->data[$locale]['cycles'] ??= [];

            if (count($count) >= 5) throw new \Exception('Límite de ciclos alcanzado (Max. 5).');

            $this->data[$locale]['cycles'][] = [
                'title' => '',
                'order' => count($count) + 1,
                'image' => NULL,
            ];
        } catch (\Exception $e) {
            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function removeCycle($locale, $idx)
    {
        unset($this->data[$locale]['cycles'][$idx]);
        $this->data[$locale]['cycles'] = array_values($this->data[$locale]['cycles']);

        if (isset($this->tmpImages[$locale]['cycles'])) {
            unset($this->tmpImages[$locale]['cycles'][$idx]);
            $this->tmpImages[$locale]['cycles'] = array_values($this->tmpImages[$locale]['cycles']);
        }
    }

    public function save()
    {
        $this->validate();

        $this->services->save([
            'services_information' => $this->data,
            'tmp_images' => $this->tmpImages,
        ]);

        Flux::toast(
            heading: 'Configuración Actualizada',
            text: 'La configuración ha sido actualizada exitosamente.',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.services.index')
            ->title('Company Services | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'data.*.homepage.heading' => 'required|string|max:150',
            'data.*.homepage.description' => 'required|string|max:2000',
            'data.*.homepage.importantMessage' => 'required|string|max:2000',
            'data.*.homepage.disclaimer' => 'required|string|max:250',
            'data.*.hero.title' => 'required|string|max:150',
            'data.*.hero.description' => 'required|string|max:2000',
            'data.*.cycles' => 'required|array|min:1|max:5',
            'data.*.cycles.*.title' => 'required|string|max:250',
            'data.*.cycles.*.order' => 'required|integer|min:1|max:10',
            'tmpImages.*.homepage' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=600,height=1000',
            'tmpImages.*.hero' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=1000,height=330',
            'tmpImages.*.cycles.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=1000,height=550',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'data.es.homepage.heading' => 'título (es)',
            'data.es.homepage.description' => 'descripción (es)',
            'data.es.homepage.importantMessage' => 'mensaje (es)',
            'data.es.homepage.disclaimer' => 'aviso (es)',
            'data.es.hero.title' => 'título (es)',
            'data.es.hero.description' => 'título (es)',
            'data.es.cycles' => 'ciclos (es)',
            'data.es.cycles.*.title' => 'título (es)',
            'data.es.cycles.*.order' => 'orden (es)',

            'tmpImages.es.homepage' => 'imagen (es)',
            'tmpImages.es.hero' => 'imagen (es)',
            'tmpImages.es.cycles.*' => 'imagen (es)',

            'data.en.homepage.heading' => 'título (en)',
            'data.en.homepage.description' => 'descripción (en)',
            'data.en.homepage.importantMessage' => 'mensaje (en)',
            'data.en.homepage.disclaimer' => 'aviso (en)',
            'data.en.hero.title' => 'título (en)',
            'data.en.hero.description' => 'descripción (en)',
            'data.en.cycles' => 'ciclos (en)',
            'data.en.cycles.*.title' => 'título (en)',
            'data.en.cycles.*.order' => 'orden (en)',

            'tmpImages.en.homepage' => 'imagen (en)',
            'tmpImages.en.hero' => 'imagen (en)',
            'tmpImages.en.cycles.*' => 'imagen (en)',
        ];
    }
}
