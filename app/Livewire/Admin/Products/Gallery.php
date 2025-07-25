<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductImages;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

final class Gallery extends Component
{
    use WithFileUploads;

    public Product $product;

    #[Validate]
    public $previewImage;

    public function rules()
    {
        return [
            'previewImage' => [
                'image',
                'max:4500',
                'mimes:jpeg,png,jpg,webp',
                // 'dimensions:min_width=1000,min_height=1000,max_width=1000,max_height=1000'
            ],
        ];
    }

    public function remove(ProductImages $image)
    {
        try {
            DB::transaction(function () use ($image) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }

                $image->delete();
            });
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Server Error',
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
                $count = count($this->product->images);

                if ($count >= 4) {
                    throw new Exception('No puedes agregar más de 4 imagenes.');
                }

                $upload = $this->previewImage->store(path: 'uploads/products', options: 'public');

                if (Storage::disk('public')->missing($upload)) {
                    throw new Exception('El archivo no existe. Intenta nuevamente.');
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read(Storage::disk('public')->get($upload));
                $image->resize(1000, 1000);
                $image->toWebp(60);
                $image->save(Storage::disk('public')->path($upload));

                $this->product->images()->create([
                    'filename' => $this->previewImage->getClientOriginalName(),
                    'original_name' => $this->previewImage->getClientOriginalName(),
                    'path' => $upload,
                    'mime_type' => 'webp',
                    'size' => Storage::disk('public')->size($upload),
                    'width' => 1000,
                    'height' => 1000,
                    'order' => $count++,
                ]);

                Flux::toast(
                    heading: 'Imagen agregada',
                    text: 'La imagen ha sido agregada correctamente.',
                    variant: 'success',
                );

                $this->reset(['previewImage']);
            });
        } catch (Exception $e) {
            report($e);

            Flux::toast(
                heading: 'Server Error',
                text: $e->getMessage(),
                variant: 'danger',
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.products.gallery', [
            'images' => $this->product->fresh()->images,
        ]);
    }
}
