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
final class SettingCompetitiveAdvantagesManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $competitiveAdvantages = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $tmp_images = [
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
        $this->competitiveAdvantages = $this->services->loadCompetitiveAdvantages();
    }

    public function updatedTmpImages($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) >= 3) {
            $locale = $parts[0];
            $index = $parts[1];

            if (isset($value)) {
                $this->tmp_images[$locale][$index] = $value;
                $this->competitiveAdvantages[$locale][$index]['image'] = $value;
            }
        }
    }

    public function add($locale = 'es')
    {
        $this->competitiveAdvantages[$locale][] = [
            'title' => '',
            'description' => '',
            'image' => null,
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->competitiveAdvantages[$locale][$index]);
        unset($this->tmp_images[$locale][$index]);

        $this->competitiveAdvantages[$locale] = array_values($this->competitiveAdvantages[$locale]);
        $this->tmp_images[$locale] = array_values($this->tmp_images[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->saveCompetitiveAdvantages([
            'competitive_advantages' => $this->competitiveAdvantages,
        ]);

        Flux::toast(
            heading: 'Configuración actualizada',
            text: 'La configuración ha sido actualizada exitosamente.',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.competitive-advantages')
            ->title('Competitive Advantages | Settings | Management');
    }

    protected function rules(): array
    {
        return [
            'competitiveAdvantages.*.*.title' => 'required|string|max:100',
            'competitiveAdvantages.*.*.description' => 'required|string|max:1000',
            'competitiveAdvantages.*.*.image' => 'nullable',

            'tmp_images.*.*' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
                'dimensions:min_width=400,min_height=400,max_width=1000,max_height=1000',
            ],
        ];
    }
}
