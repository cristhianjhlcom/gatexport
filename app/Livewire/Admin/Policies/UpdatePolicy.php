<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Policies;

use App\Enums\RolesEnum;
use App\Models\Policy;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class UpdatePolicy extends Component
{
    public Policy $policy;

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

    public function mount(Policy $policy)
    {
        $this->title = $policy->title;
        $this->slug = $policy->slug;
        $this->content = $policy->content;
        $this->policy = $policy;
    }

    public function update()
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->policy->update($this->pull(['title', 'slug', 'content']));

        return to_route('admin.policies.index');
    }

    public function render()
    {
        return view('livewire.admin.policies.update-policy')
            ->layout('components.layouts.admin')
            ->title("Actualizar {$this->policy->title['es']}");
    }

    protected function rules(): array
    {
        return [
            'title.*' => 'required|string|max:90',
            'slug' => ['required', Rule::unique('policies')->ignore($this->policy->id)],
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
