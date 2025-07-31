<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Models\Subcategory;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\{DB, Storage};
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

final class SubcategoryManagementForm extends Form
{
    public ?Subcategory $subcategory = null;

    #[Validate]
    public $name = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public string $slug = '';

    #[Validate]
    public $image = null;

    #[Validate]
    public $category_id = null;

    public function setSubcategory(Subcategory $subcategory): void
    {
        $this->name = $subcategory->name;
        $this->slug = $subcategory->slug;
        $this->image = $subcategory->image;
        $this->category_id = $subcategory->category_id;
        $this->subcategory = $subcategory;
    }

    public function store(): Subcategory
    {
        $this->validate();

        return DB::transaction(function () {
            $name = [
                'es' => str()->title($this->name['es']),
                'en' => str()->title($this->name['en']),
            ];

            $subcatetegory = Subcategory::create([
                'name' => $name,
                'slug' => $this->slug,
                'image' => $this->upload($this->image),
                'category_id' => $this->category_id,
            ]);

            return $subcatetegory->fresh();
        });
    }

    public function update(): Subcategory
    {
        $this->validate();

        return DB::transaction(function () {
            $name = [
                'es' => str()->title($this->name['es']),
                'en' => str()->title($this->name['en']),
            ];

            $this->subcategory->update([
                'name' => $name,
                'slug' => $this->slug,
                'image' => $this->upload($this->image),
                'category_id' => $this->category_id,
            ]);

            return $this->subcategory->fresh();
        });
    }

    protected function rules(): array
    {
        $rules = [
            'name.*' => 'required|string|min:3|max:90',
            'slug' => [
                'required',
                'string',
                Rule::unique('subcategories', 'slug')->ignore($this->subcategory?->id),
            ],
            'category_id' => 'required|exists:categories,id',
        ];

        return $rules;
    }

    protected function upload($image)
    {
        if (!$image) throw new Exception('No se pudo subir la imagen');

        if ($this->subcategory && $image === $this->subcategory->image) return $this->subcategory->image;

        if ($this->subcategory && Storage::disk('public')->exists($this->subcategory->image)) {
            Storage::disk('public')->delete($this->subcategory->image);
        }

        $upload = $image->store(path: 'uploads/subcategories', options: 'public');

        if (Storage::disk('public')->missing($upload)) {
            throw new Exception('El archivo no existe. Intenta nuevamente.');
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read(Storage::disk('public')->get($upload));
        $image->resize(1000, 1000);
        $image->toWebp(60);
        $image->save(Storage::disk('public')->path($upload));

        Flux::toast('Imagen procesada correctamente.', 'success');

        return $upload;
    }
}
