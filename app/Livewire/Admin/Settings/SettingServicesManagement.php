<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\CompanyServicesSettingService;
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
            $key = $parts[1];

            if (isset($value) && is_object($value) && method_exists($value, 'store')) {
                $this->tmpImages[$locale][$key] = $value;
                // $this->data[$locale][$key]['image'] = $value;
            }
            return;
        }

        if (count($parts) == 3) {
            $locale = $parts[0];
            $key = $parts[1];
            $idx = $parts[2];

            if (isset($value) && is_object($value) && method_exists($value, 'store')) {
                $this->tmpImages[$locale][$key][$idx] = $value;
                // $this->data[$locale][$key][$idx]['image'] = $value;
            }
            return;
        }
    }

    public function addService($locale = 'es')
    {
        try {
            $count = $this->data[$locale]['services'] ??= [];

            if (count($count) >= 5) throw new \Exception('Límite de servicios (Max. 5).');

            $this->data[$locale]['services'][] = [
                'title' => '',
                'description' => '',
                'disclaimer' => '',
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

    public function removeService($locale, $idx)
    {
        unset($this->data[$locale]['services'][$idx]);
        $this->data[$locale]['services'] = array_values($this->data[$locale]['services']);

        if (isset($this->tmpImages[$locale]['services'])) {
            unset($this->tmpImages[$locale]['services'][$idx]);
            $this->tmpImages[$locale]['services'] = array_values($this->tmpImages[$locale]['services']);
        }
    }

    public function addCycle($locale = 'es')
    {
        try {
            $count = $this->data[$locale]['cycles'] ??= [];

            if (count($count) >= 5) throw new \Exception('Límite de ciclos (Max. 5).');

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

    public function addBenefit($locale = 'es')
    {
        try {
            $count = $this->data[$locale]['benefits'] ??= [];

            if (count($count) >= 5) throw new \Exception('Límite de beneficios (Max. 5).');

            $this->data[$locale]['benefits'][] = [
                'title' => '',
                'description' => '',
                'order' => count($count) + 1,
                'image' => NULL,
                'background' => NULL,
            ];
        } catch (\Exception $e) {
            Flux::toast(
                heading: 'Ups! Algo salió mal',
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function removeBenefit($locale, $idx)
    {
        unset($this->data[$locale]['benefits'][$idx]);
        $this->data[$locale]['benefits'] = array_values($this->data[$locale]['benefits']);

        if (isset($this->tmpImages[$locale]['benefits'])) {
            unset($this->tmpImages[$locale]['benefits'][$idx]['image']);
            unset($this->tmpImages[$locale]['benefits'][$idx]['background']);

            $this->tmpImages[$locale]['benefits'] = array_values($this->tmpImages[$locale]['benefits']);
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
            'data.*.services' => 'required|array|min:1|max:5',
            'data.*.services.*.title' => 'required|string|max:250',
            'data.*.services.*.description' => 'required|string|max:2000',
            'data.*.services.*.disclaimer' => 'required|string|max:200',
            'data.*.services.*.order' => 'required|integer|min:1|max:10',
            'data.*.authority.content' => 'required|string|max:2000',
            'tmpImages.*.homepage' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=600,height=1000',
            'tmpImages.*.hero' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=1000,height=330',
            'tmpImages.*.cycles.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=1000,height=550',
            'tmpImages.*.services.*' => 'image|mimes:png,jpg,jpeg,webp|max:1024|dimensions:width=55,height=55',
            'data.*.benefits' => 'required|array|min:1|max:5',
            'data.*.benefits.*.title' => 'required|string|max:250',
            'data.*.benefits.*.description' => 'required|string|max:2000',
            'data.*.benefits.*.order' => 'required|integer|min:1|max:10',
            'tmpImages.*.benefits.*.image' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=600,height=450',
            'tmpImages.*.benefits.*.background' => 'image|mimes:png,jpg,jpeg,webp|max:2048|dimensions:width=900,height=350',
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
            'data.es.services' => 'servicios (es)',
            'data.es.services.*.title' => 'título (es)',
            'data.es.services.*.description' => 'descripción (es)',
            'data.es.services.*.disclaimer' => 'aviso (es)',
            'data.es.services.*.order' => 'orden (es)',
            'data.es.authority.content' => 'contenido (es)',
            'data.es.benefits.*.title' => 'título (es)',
            'data.es.benefits.*.description' => 'descripción (es)',
            'data.es.benefits.*.order' => 'orden (es)',

            'tmpImages.es.homepage' => 'imagen (es)',
            'tmpImages.es.hero' => 'imagen (es)',
            'tmpImages.es.cycles.*' => 'imagen (es)',
            'tmpImages.es.services.*' => 'imagen (es)',
            'tmpImages.es.benefits.*.image' => 'imagen (es)',
            'tmpImages.es.benefits.*.background' => 'fondo (es)',

            'data.en.homepage.heading' => 'título (en)',
            'data.en.homepage.description' => 'descripción (en)',
            'data.en.homepage.importantMessage' => 'mensaje (en)',
            'data.en.homepage.disclaimer' => 'aviso (en)',
            'data.en.hero.title' => 'título (en)',
            'data.en.hero.description' => 'descripción (en)',
            'data.en.cycles' => 'ciclos (en)',
            'data.en.cycles.*.title' => 'título (en)',
            'data.en.cycles.*.order' => 'orden (en)',
            'data.en.services' => 'servicios (en)',
            'data.en.services.*.title' => 'título (en)',
            'data.en.services.*.description' => 'descripción (en)',
            'data.en.services.*.disclaimer' => 'aviso (en)',
            'data.en.services.*.order' => 'orden (en)',
            'data.en.authority.content' => 'contenido (en)',
            'data.en.benefits.*.title' => 'título (en)',
            'data.en.benefits.*.description' => 'descripción (en)',
            'data.en.benefits.*.order' => 'orden (en)',

            'tmpImages.en.homepage' => 'imagen (en)',
            'tmpImages.en.hero' => 'imagen (en)',
            'tmpImages.en.cycles.*' => 'imagen (en)',
            'tmpImages.en.services.*' => 'imagen (en)',
            'tmpImages.en.benefits.*.image' => 'imagen (en)',
            'tmpImages.en.benefits.*.background' => 'fondo (en)',
        ];
    }
}
