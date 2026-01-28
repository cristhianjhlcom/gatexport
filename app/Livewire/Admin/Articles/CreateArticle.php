<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Articles;

use App\Enums\RolesEnum;
use App\Models\Article;
use App\Traits\ImageUploads;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

final class CreateArticle extends Component
{
    use ImageUploads, WithFileUploads;

    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    #[Validate]
    public array $title = [
        'es' => '',
        'en' => '',
    ];

    public string $slug = '';

    public array $summary = [
        'es' => '',
        'en' => '',
    ];

    public array $content = [
        'es' => '',
        'en' => '',
    ];

    public $thumbnail = null;

    public array $seo = [
        'title' => [
            'es' => '',
            'en' => '',
        ],
        'description' => [
            'es' => '',
            'en' => '',
        ],
        'thumbnail' => null,
    ];

    public bool $is_published = true;

    public function updatedTitleEs(string $name): void
    {
        $this->slug = str()->slug($name);
    }

    public function save()
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->validate();

        Article::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'summary' => $this->summary,
            'is_published' => $this->is_published,
            'thumbnail' => $this->upload([
                'currentPath' => null,
                'newFile' => $this->thumbnail,
                'directory' => 'uploads/articles',
            ]),
            'seo_title' => $this->seo['title'],
            'seo_description' => $this->seo['description'],
            'seo_thumbnail' => $this->upload([
                'currentPath' => null,
                'newFile' => $this->seo['thumbnail'],
                'directory' => 'uploads/articles',
            ]),
        ]);

        $this->reset();

        return to_route('admin.articles.index');
    }

    public function render()
    {
        return view('livewire.admin.articles.create-article')
            ->layout('components.layouts.admin')
            ->title('Crear artículo');
    }

    protected function rules(): array
    {
        return [
            'title.*' => 'required|string|max:90',
            'slug' => 'required|unique:articles,slug',
            'summary.*' => 'required|string|max:500',
            'content.*' => 'required|string|max:6000',
            'thumbnail' => 'nullable|image|dimensions:width=1050,height=780|max:2048',
            'seo.title.*' => 'required|string|max:60',
            'seo.description.*' => 'required|string|max:160',
            'seo.thumbnail' => 'nullable|image|dimensions:width=1050,height=780|max:2048',
            'is_published' => 'boolean',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'title.es' => 'título (es)',
            'title.en' => 'título (en)',
            'content.es' => 'contenido (es)',
            'content.en' => 'contenido (en)',
            'summary.es' => 'resumen (es)',
            'summary.en' => 'resumen (en)',
            'seo.title.es' => 'titulo seo (es)',
            'seo.title.en' => 'titulo seo (en)',
            'seo.description.es' => 'contenido seo (es)',
            'seo.description.en' => 'contenido seo (en)',
            'is_published' => 'publicado',
        ];
    }
}
