<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Services\SettingManagementServices;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingServicesManagement extends Component
{
    use WithFileUploads;

    #[Session('admin.companyServices')]
    #[Validate]
    public $companyServices = [
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

    public function add($locale = 'es')
    {
        $this->companyServices[$locale][] = [
            'title' => '',
            'description' => '',
        ];
    }

    public function remove($locale, $index)
    {
        unset($this->companyServices[$locale][$index]);

        $this->companyServices[$locale] = array_values($this->companyServices[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->saveCompanyServices([
            'company_services' => $this->companyServices,
        ]);

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
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
        ];
    }
}
