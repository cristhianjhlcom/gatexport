<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Policies;

use App\Enums\RolesEnum;
use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Crear política')]
final class CreatePolicy extends Component
{
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

    public array $content = [
        'es' => '',
        'en' => '',
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

        Policy::create($this->pull(['title', 'slug', 'content', 'is_published']));

        return to_route('admin.policies.index');
    }

    public function render()
    {
        return view('livewire.admin.policies.create-policy');
    }

    protected function rules(): array
    {
        return [
            'title.*' => 'required|string|max:90',
            'slug' => 'required|unique:policies,id',
            'content.*' => 'required|string|max:2000',
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
            'is_published' => 'publicado',
        ];
    }
}
