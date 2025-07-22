<?php

namespace App\Livewire\Public\Products;

use App\Models\ProductImages;
use Illuminate\Support\Collection;
use Livewire\Component;

class Gallery extends Component
{
    public Collection $images;
    public ProductImages $selectedImage;

    public function mount()
    {
        if (!empty($this->images)) {
            $this->selectedImage = $this->images[0];
            return;
        }

        $this->images = collect();
        $this->selectedImage = new ProductImages;
    }

    public function selectImage(ProductImages $image)
    {
        $this->selectedImage = $image;
    }

    public function render()
    {
        return view('livewire.public.products.gallery');
    }
}
