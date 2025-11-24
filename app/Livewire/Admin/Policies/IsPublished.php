<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Policies;

use App\Models\Policy;
use Flux\Flux;
use Livewire\Component;

final class IsPublished extends Component
{
    public Policy $policy;

    public function toggle()
    {
        $this->policy->update([
            'is_published' => ! $this->policy->is_published,
        ]);

        Flux::toast(
            heading: 'Manejo de Políticas',
            text: 'Se actualizó el estado de publicación correctamente',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.policies.is-published');
    }
}
