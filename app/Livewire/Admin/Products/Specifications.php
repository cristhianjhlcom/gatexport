<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductSpecifications;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Specifications extends Component
{
    public Product $product;

    #[Validate('required|string|max:60', as: "clave")]
    public string $key = '';

    #[Validate('required|string|max:60', as: "valor")]
    public string $value = '';

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function remove(ProductSpecifications $specification)
    {
        $specification->delete();
    }

    public function add()
    {
        $this->validate();

        $this->product->specifications()->create([
            'key' => str()->title($this->key),
            'value' => str()->title($this->value),
        ]);

        Flux::toast(
            heading: 'Especificación agregada',
            text: 'La especificación ha sido agregada correctamente.',
            variant: 'success',
        );

        Flux::modal('add-specs')->close();

        $this->reset(['key', 'value']);
    }

    public function render()
    {
        return view('livewire.admin.products.specifications', [
            'specifications' => $this->product->fresh()->specifications,
        ]);
    }
}
