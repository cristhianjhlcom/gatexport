<?php

declare(strict_types=1);

namespace App\Livewire\Admin\CatalogFiles;

use App\Enums\RolesEnum;
use App\Models\CatalogFile;
use App\Traits\ImageUploads;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

final class ShowCatalogs extends Component
{
    use ImageUploads, WithFileUploads;

    public ?CatalogFile $catalog = null;

    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    public array $savedFile = [
        'es' => null,
        'en' => null,
    ];

    #[Validate]
    public array $title = [
        'es' => null,
        'en' => null,
    ];

    public array $short_description = [
        'es' => null,
        'en' => null,
    ];

    public array $file = [
        'es' => null,
        'en' => null,
    ];

    public function edit(CatalogFile $catalog): void
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->title = $catalog->title;
        $this->short_description = $catalog->short_description;
        $this->savedFile = $catalog->filepath;
        $this->catalog = $catalog;

        $this->modal('create-catalog')->show();
    }

    public function delete(CatalogFile $catalog): void
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->deleteUpload($catalog->filepath['es']);
        $this->deleteUpload($catalog->filepath['en']);

        $catalog->delete();
    }

    public function save(): void
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->validate();

        $uploaded = [
            'es' => $this->upload([
                'currentPath' => $this->savedFile['es'],
                'newFile' => $this->file['es'],
                'directory' => 'uploads/catalogs',
            ]),
            'en' => $this->upload([
                'currentPath' => $this->savedFile['en'],
                'newFile' => $this->file['en'],
                'directory' => 'uploads/catalogs',
            ]),
        ];

        CatalogFile::updateOrCreate(
            [
                'id' => $this->catalog?->id,
            ],
            [
                'title' => $this->title,
                'short_description' => $this->short_description,
                'filepath' => $uploaded,
            ]
        );

        $this->modal('create-catalog')->close();

        $this->reset([
            'title',
            'short_description',
            'file',
            'catalog',
            'savedFile',
        ]);
    }

    public function render()
    {
        $files = CatalogFile::query()
            ->latest()
            ->paginate(8);

        return view('livewire.admin.catalog-files.show-catalogs', compact('files'))
            ->layout('components.layouts.admin')
            ->title('Manejo de archivos de catálogos');
    }

    protected function rules(): array
    {
        $rules = [
            'title.*' => 'nullable|string|max:90',
            'short_description.*' => 'nullable|string|max:300',
        ];

        if ($this->savedFile['es']) {
            // 'dimensions:min_width=300,min_height=450,max_width=300,max_height=450',
            $rules['file.es'] = 'nullable|image|dimensions:min_width=980,min_height=620,max_width=1080,max_height=780|max:2048';
        } else {
            $rules['file.es'] = 'required|image|dimensions:min_width=980,min_height=620,max_width=1080,max_height=780|max:2048';
        }

        if ($this->savedFile['en']) {
            $rules['file.en'] = 'nullable|image|dimensions:min_width=980,min_height=620,max_width=1080,max_height=780|max:2048';
        } else {
            $rules['file.en'] = 'required|image|dimensions:min_width=980,min_height=620,max_width=1080,max_height=780|max:2048';
        }

        return $rules;
    }

    protected function validationAttributes(): array
    {
        return [
            'title.es' => 'título (es)',
            'title.en' => 'título (en)',
            'short_description.es' => 'descripción corta (es)',
            'short_description.en' => 'descripción corta (en)',
            'file.es' => 'archivo del pdf (es)',
            'file.en' => 'archivo del pdf (en)',
        ];
    }
}
