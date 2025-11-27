<?php

namespace App\Livewire\Admin\CatalogFiles;

use App\Enums\RolesEnum;
use App\Models\CatalogFile;
use App\Traits\ImageUploads;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowCatalogs extends Component
{
    use ImageUploads, WithFileUploads;

    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    public array $savedFile = [
        'es' => NULL,
        'en' => NULL,
    ];

    #[Validate]
    public array $title = [
        'es' => '',
        'en' => '',
    ];

    public array $short_description = [
        'es' => '',
        'en' => '',
    ];

    public array $file = [
        'es' => NULL,
        'en' => NULL,
    ];

    public function save(): void
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->validate();

        foreach ($this->locales as $locale => $_) {
            $uploaded = $this->upload([
                'currentPath' => $this->savedFile[$locale],
                'newFile' => $this->file[$locale],
                'directory' => 'uploads/catalogs',
            ]);

            CatalogFile::create([
                'title' => [
                    $locale => $this->title[$locale],
                ],
                'short_description' => [
                    $locale => $this->short_description[$locale],
                ],
                'filepath' => $uploaded,
            ]);
        }

        $this->reset(['title', 'short_description', 'file']);
    }

    public function render()
    {
        $files = CatalogFile::query()
            ->paginate(8);

        return view('livewire.admin.catalog-files.show-catalogs', compact('files'))
            ->layout('components.layouts.admin')
            ->title('Manejo de archivos de catálogos');
    }

    protected function rules(): array
    {
        return [
            'title.*' => 'optional|string|max:90',
            'short_description.*' => 'optional|string|max:300',
            'file.es' => 'required|mimes:pdf|max:5120',
            'file.en' => 'required|mimes:pdf|max:5120'
        ];
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
