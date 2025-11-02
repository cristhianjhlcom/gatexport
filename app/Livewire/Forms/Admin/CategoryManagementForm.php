<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Models\Category;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class CategoryManagementForm extends Form
{
    public ?Category $category = null;

    #[Validate]
    public $name = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public string $slug = '';

    #[Validate]
    public ?string $backgroundColor = NULL;

    #[Validate]
    public $image = NULL;

    #[Validate]
    public $whiteIcon = NULL;

    #[Validate]
    public $primaryIcon = NULL;

    public function setCategory(Category $category): void
    {
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->backgroundColor = $category->background_color;
        $this->whiteIcon = $category->icon_white;
        $this->primaryIcon = $category->icon_primary;
        $this->category = $category;
    }

    public function store(): Category
    {
        $this->validate();

        return DB::transaction(function () {
            $name = [
                'es' => str()->title($this->name['es']),
                'en' => str()->title($this->name['en']),
            ];

            $iconArgs = [
                'width' => 55,
                'height' => 55,
                'quality' => 80,
            ];

            $imageArgs = [
                'width' => 1000,
                'height' => 550,
                'quality' => 60,
            ];

            $catetegory = Category::create([
                'name' => $name,
                'slug' => $this->slug,
                'background_color' => $this->backgroundColor,
                'image' => $this->upload($this->image, $imageArgs),
                'icon_white' => $this->upload($this->whiteIcon, $iconArgs),
                'icon_primary' => $this->upload($this->primaryIcon, $iconArgs),
            ]);

            return $catetegory->fresh();
        });
    }

    public function update(): Category
    {
        $this->validate();

        return DB::transaction(function () {
            $name = [
                'es' => str()->title($this->name['es']),
                'en' => str()->title($this->name['en']),
            ];

            $iconArgs = [
                'width' => 55,
                'height' => 55,
                'quality' => 80,
            ];

            $imageArgs = [
                'width' => 1000,
                'height' => 550,
                'quality' => 60,
            ];

            $this->category->update([
                'name' => $name,
                'slug' => $this->slug,
                'background_color' => $this->backgroundColor,
                'image' => $this->upload($this->image, $imageArgs),
                'icon_white' => $this->upload($this->whiteIcon, $iconArgs),
                'icon_primary' => $this->upload($this->primaryIcon, $iconArgs),
            ]);

            return $this->category->fresh();
        });
    }

    protected function rules(): array
    {
        $rules = [
            'name.*' => 'required|string|min:3|max:90',
            'backgroundColor' => 'nullable|string|min:4|max:7',
            'slug' => [
                'required',
                'string',
                Rule::unique('categories', 'slug')->ignore($this->category?->id),
            ],
            'image' => 'required',
            'whiteIcon' => 'required',
            'primaryIcon' => 'required',
        ];

        return $rules;
    }

    protected function upload($image, $args)
    {
        if (! $image) {
            throw new Exception('No se pudo subir la imagen');
        }

        if ($this->category && $image === $this->category->image) {
            return $this->category->image;
        }

        if ($this->category && Storage::disk('public')->exists($this->category->image)) {
            Storage::disk('public')->delete($this->category->image);
        }

        $upload = $image->store(path: 'uploads/categories', options: 'public');

        if (Storage::disk('public')->missing($upload)) {
            throw new Exception('El archivo no existe. Intenta nuevamente.');
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read(Storage::disk('public')->get($upload));
        $image->resize($args['width'], $args['height']);
        $image->toWebp($args['quality']);
        // $image->resize(450, 200);
        // $image->toWebp(60);
        $image->save(Storage::disk('public')->path($upload));

        Flux::toast('Imagen procesada correctamente.', 'success');

        return $upload;
    }
}
