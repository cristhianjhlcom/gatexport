<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Policies;

use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Manejo de Políticas')]
final class PolicyManagement extends Component
{
    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    public function render()
    {
        $policies = Policy::query()
            ->latest()
            ->paginate(8);

        return view('livewire.admin.policies.index', compact('policies'));
    }
}
