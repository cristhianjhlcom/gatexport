<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Models\Category;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class CategoryManagementForm extends Form
{
    use ImageUploads;

    public ?Category $category = null;

    #[Validate]
    public $name = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public string $slug = '';

    public $description = [
        'en' => '',
        'es' => '',
    ];

    public $position = 0;

    public $backgroundImage = [
        'en' => '',
        'es' => '',
    ];

    public ?string $backgroundColor = null;

    public $tmpImages = [
        'image' => null,
        'icon_white' => null,
        'icon_primary' => null,
        'seo_image' => null,
        'background_image' => null,
    ];

    public $seo = [
        'title' => [],
        'description' => [],
    ];

    public function setCategory(Category $category): void
    {
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->position = $category->position;
        $this->backgroundColor = $category->background_color;

        $categoryBackgroundImage = $category->background_image ??= [];
        $this->backgroundImage['es'] = $categoryBackgroundImage['es'] ?? '';
        $this->backgroundImage['en'] = $categoryBackgroundImage['en'] ?? '';

        // Populate description locales safely
        $categoryDescription = $category->description ?? [];
        $this->description['es'] = $categoryDescription['es'] ?? '';
        $this->description['en'] = $categoryDescription['en'] ?? '';

        // Populate SEO locales safely
        $categorySeoTitle = $category->seo_title ?? [];
        $categorySeoDescription = $category->seo_description ?? [];
        $this->seo['title']['es'] = $categorySeoTitle['es'] ?? '';
        $this->seo['title']['en'] = $categorySeoTitle['en'] ?? '';
        $this->seo['description']['es'] = $categorySeoDescription['es'] ?? '';
        $this->seo['description']['en'] = $categorySeoDescription['en'] ?? '';
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

            $category = Category::create([
                'name' => $name,
                'slug' => $this->slug,
                'background_color' => $this->backgroundColor,
                'description' => $this->description,
                'background_image' => [
                    'es' => $this->upload([
                        'currentPath' => data_get($this->category?->background_image, 'es'),
                        'newFile' => $this->tmpImages['background_image']['es'] ?? null,
                        'directory' => 'uploads/categories',
                    ]),
                    'en' => $this->upload([
                        'currentPath' => data_get($this->category?->background_image, 'en'),
                        'newFile' => $this->tmpImages['background_image']['en'] ?? null,
                        'directory' => 'uploads/categories',
                    ]),
                ],
                'position' => $this->position,
                'seo_title' => $this->seo['title'],
                'seo_description' => $this->seo['description'],
                'icon_white' => $this->upload([
                    'currentPath' => $this->category?->icon_white ?? null,
                    'newFile' => $this->tmpImages['icon_white'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
                'icon_primary' => $this->upload([
                    'currentPath' => $this->category?->icon_primary ?? null,
                    'newFile' => $this->tmpImages['icon_primary'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
                'seo_image' => $this->upload([
                    'currentPath' => $this->category?->seo_image ?? null,
                    'newFile' => $this->tmpImages['seo_image'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
            ]);

            return $category->fresh();
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

            $this->category->update([
                'name' => $name,
                'slug' => $this->slug,
                'background_color' => $this->backgroundColor,
                'description' => $this->description,
                'seo_title' => $this->seo['title'],
                'seo_description' => $this->seo['description'],
                'position' => $this->position,
                'background_image' => [
                    'es' => $this->upload([
                        'currentPath' => data_get($this->category?->background_image, 'es'),
                        'newFile' => $this->tmpImages['background_image']['es'] ?? null,
                        'directory' => 'uploads/categories',
                    ]),
                    'en' => $this->upload([
                        'currentPath' => data_get($this->category?->background_image, 'en'),
                        'newFile' => $this->tmpImages['background_image']['en'] ?? null,
                        'directory' => 'uploads/categories',
                    ]),
                ],
                'icon_white' => $this->upload([
                    'currentPath' => $this->category->icon_white ?? null,
                    'newFile' => $this->tmpImages['icon_white'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
                'icon_primary' => $this->upload([
                    'currentPath' => $this->category->icon_primary ?? null,
                    'newFile' => $this->tmpImages['icon_primary'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
                'seo_image' => $this->upload([
                    'currentPath' => $this->category->seo_image ?? null,
                    'newFile' => $this->tmpImages['seo_image'] ?? null,
                    'directory' => 'uploads/categories',
                ]),
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
            'description.*' => 'nullable|string|max:1000',
            'seo.title.*' => 'nullable|string|max:70',
            'seo.description.*' => 'nullable|string|max:160',
            'tmpImages.*' => 'nullable',
        ];

        return $rules;
    }
}
