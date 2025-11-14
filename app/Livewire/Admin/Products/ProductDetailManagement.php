<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Services\Setting\ProductPageManagementService;
use Exception;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Página de producto')]
final class ProductDetailManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public array $details = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public array $tmp = [
        'es' => [],
        'en' => [],
    ];

    protected ProductPageManagementService $services;

    protected array $rules = [
        'details.*.title' => 'required|string|max:100',
        'details.*.description' => 'required|string|max:2000',
        'details.*.altText' => 'nullable|string|max:125',
        'details.*.seo.title' => 'nullable|string|max:60',
        'details.*.seo.description' => 'nullable|string|max:160',
        'tmp.*.backgroundImage' => 'image|dimensions:min_width=1000,max_width=1920,min_height=300,max_height=392|max:1024|mimes:jpeg,png,jpg,webp',
        'tmp.*.seo.image' => 'image|dimensions:width=500,height=500|max:1024|mimes:jpeg,png,jpg,webp',
    ];

    public function boot()
    {
        $this->services = app(ProductPageManagementService::class);
    }

    public function mount()
    {
        $this->details = $this->services->load();
    }

    public function save()
    {
        try {
            $this->validate();

            $this->services->save([
                'details' => $this->details,
                'tmp' => $this->tmp,
            ]);

            Flux::toast(
                heading: 'Configuración actualizada',
                text: 'La configuración ha sido actualizada correctamente',
                variant: 'success',
            );

            redirect()->route('admin.products.detail');
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Error',
                text: 'Ha ocurrido un error al actualizar la configuración',
                variant: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.products.detail');
    }
}
