<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin;

use App\Models\Subcategory;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class SubcategoryManagementForm extends Form
{
    use ImageUploads;

    public ?Subcategory $subcategory = null;

    #[Validate]
    public $name = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public string $slug = '';

    #[Validate]
    public $description = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public $backgroundImage = [
        'en' => '',
        'es' => '',
    ];

    #[Validate]
    public ?string $backgroundColor = null;

    #[Validate]
    public $tmpImages = [
        'image' => null,
        'icon_white' => null,
        'icon_primary' => null,
        'seo_image' => null,
        'background_image' => null,
    ];

    #[Validate]
    public $seo = [
        'title' => [],
        'description' => [],
    ];

    #[Validate]
    public $category_id = null;

    public function setSubcategory(Subcategory $subcategory): void
    {
        $this->name = $subcategory->name;
        $this->slug = $subcategory->slug;
        $this->backgroundColor = $subcategory->background_color;

        $this->tmpImages['image'] = null;
        $this->tmpImages['icon_white'] = null;
        $this->tmpImages['icon_primary'] = null;
        $this->tmpImages['seo_image'] = null;
        $this->tmpImages['background_image'] = [
            'es' => null,
            'en' => null,
        ];

        $this->category_id = $subcategory->category_id;

        // Populate multilingual fields safely
        $subcategoryDescription = $subcategory->description ?? [];
        $this->description['es'] = $subcategoryDescription['es'] ?? '';
        $this->description['en'] = $subcategoryDescription['en'] ?? '';

        $subcategoryBackground = $subcategory->background_image ?? [];
        $this->backgroundImage['es'] = $subcategoryBackground['es'] ?? '';
        $this->backgroundImage['en'] = $subcategoryBackground['en'] ?? '';

        $subcategorySeoTitle = $subcategory->seo_title ?? [];
        $subcategorySeoDescription = $subcategory->seo_description ?? [];
        $this->seo['title']['es'] = $subcategorySeoTitle['es'] ?? '';
        $this->seo['title']['en'] = $subcategorySeoTitle['en'] ?? '';
        $this->seo['description']['es'] = $subcategorySeoDescription['es'] ?? '';
        $this->seo['description']['en'] = $subcategorySeoDescription['en'] ?? '';

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

            $subcategory = Subcategory::create([
                'name' => $name,
                'slug' => $this->slug,
                'image' => $this->upload([
                    'currentPath' => $this->subcategory?->image ?? null,
                    'newFile' => $this->tmpImages['image'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'category_id' => $this->category_id,
                'description' => $this->description,
                'background_image' => [
                    'es' => $this->upload([
                        'currentPath' => $this->subcategory?->background_image['es'] ?? null,
                        'newFile' => $this->tmpImages['background_image']['es'] ?? null,
                        'directory' => 'uploads/subcategories',
                    ]),
                    'en' => $this->upload([
                        'currentPath' => $this->subcategory?->background_image['en'] ?? null,
                        'newFile' => $this->tmpImages['background_image']['en'] ?? null,
                        'directory' => 'uploads/subcategories',
                    ]),
                ],
                'background_color' => $this->backgroundColor,
                'icon_white' => $this->upload([
                    'currentPath' => $this->subcategory?->icon_white ?? null,
                    'newFile' => $this->tmpImages['icon_white'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'icon_primary' => $this->upload([
                    'currentPath' => $this->subcategory?->icon_primary ?? null,
                    'newFile' => $this->tmpImages['icon_primary'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'seo_image' => $this->upload([
                    'currentPath' => $this->subcategory?->seo_image ?? null,
                    'newFile' => $this->tmpImages['seo_image'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'seo_title' => $this->seo['title'],
                'seo_description' => $this->seo['description'],
            ]);

            return $subcategory->fresh();
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
                'image' => $this->upload([
                    'currentPath' => $this->subcategory->image ?? null,
                    'newFile' => $this->tmpImages['image'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'category_id' => $this->category_id,
                'description' => $this->description,
                'background_image' => [
                    'es' => $this->upload([
                        'currentPath' => $this->subcategory?->background_image['es'] ?? null,
                        'newFile' => $this->tmpImages['backgroundImage']['es'] ?? null,
                        'directory' => 'uploads/subcategories',
                    ]),
                    'en' => $this->upload([
                        'currentPath' => $this->subcategory?->background_image['en'] ?? null,
                        'newFile' => $this->tmpImages['backgroundImage']['en'] ?? null,
                        'directory' => 'uploads/subcategories',
                    ]),
                ],
                'background_color' => $this->backgroundColor,
                'icon_white' => $this->upload([
                    'currentPath' => $this->subcategory->icon_white ?? null,
                    'newFile' => $this->tmpImages['icon_white'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'icon_primary' => $this->upload([
                    'currentPath' => $this->subcategory->icon_primary ?? null,
                    'newFile' => $this->tmpImages['icon_primary'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'seo_image' => $this->upload([
                    'currentPath' => $this->subcategory->seo_image ?? null,
                    'newFile' => $this->tmpImages['seo_image'] ?? null,
                    'directory' => 'uploads/subcategories',
                ]),
                'seo_title' => $this->seo['title'],
                'seo_description' => $this->seo['description'],
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
            'description.*' => 'nullable|string|max:1000',
            'backgroundImage.*' => 'nullable',
            'seo.title.*' => 'nullable|string|max:70',
            'seo.description.*' => 'nullable|string|max:160',
            'tmpImages.*' => 'nullable',
        ];

        return $rules;
    }
}
