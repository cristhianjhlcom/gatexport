<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductSpecifications;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class Specifications extends Component
{
    public Product $product;

    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    #[Validate]
    public $values = [
        'es' => [
            'key' => '',
            'value' => '',
        ],
        'en' => [
            'key' => '',
            'value' => '',
        ],
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function remove(ProductSpecifications $specification)
    {
        try {
            DB::transaction(function () use ($specification) {
                $specification->delete();
            });
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Ups! Server Error',
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function add()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                if ($this->product->fresh()->specifications->count() >= 5) {
                    throw new Exception('No puede agregar más de 5 especificaciones.');
                }

                $this->product->specifications()->create([
                    'key' => [],
                    'value' => $this->values,
                ]);

                Flux::toast(
                    heading: 'Especificación agregada',
                    text: 'La especificación ha sido agregada correctamente.',
                    variant: 'success',
                );

                Flux::modal('add-specs')->close();

                $this->reset(['values']);
            });
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Ups! Server Error',
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.products.specifications', [
            'specifications' => $this->product->fresh()->specifications,
        ]);
    }

    protected function rules(): array
    {
        return [
            'values.*.key' => 'required|string|max:50',
            'values.*.value' => 'required|string|max:100',
        ];
    }

    protected function messages(): array
    {
        return [
            'values.*.key.required' => 'La clave es obligatoria.',
            'values.*.key.string' => 'La clave debe ser una cadena de texto.',
            'values.*.key.max' => 'La clave no debe exceder los 50 caracteres.',
            'values.*.value.required' => 'El valor es obligatorio.',
            'values.*.value.string' => 'El valor debe ser una cadena de texto.',
            'values.*.value.max' => 'El valor no debe exceder los 100 caracteres.',
        ];
    }
}
