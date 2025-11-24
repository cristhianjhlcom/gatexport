<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Faqs;

use App\Models\FrequentlyAskedQuestion;
use Flux\Flux;
use Livewire\Component;

final class IsPublished extends Component
{
    public FrequentlyAskedQuestion $faq;

    public function toggle()
    {
        $this->faq->update([
            'is_published' => ! $this->faq->is_published,
        ]);

        Flux::toast(
            heading: 'Manejo de Preguntas Frecuentes',
            text: 'Se actualizó el estado de publicación correctamente',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.faqs.is-published');
    }
}
