<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Faqs;

use App\Enums\RolesEnum;
use App\Models\FrequentlyAskedQuestion;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Manejo de Preguntas Frecuentes')]
final class FaqManagement extends Component
{
    public ?FrequentlyAskedQuestion $faq = null;

    public array $locales = [
        'es' => 'Español',
        'en' => 'Inglés',
    ];

    #[Validate]
    public array $question = [
        'es' => '',
        'en' => '',
    ];

    #[Validate]
    public array $answer = [
        'es' => '',
        'en' => '',
    ];

    #[Validate]
    public bool $is_published = true;

    public function save()
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->validate();

        FrequentlyAskedQuestion::updateOrCreate(
            [
                'id' => $this->faq?->id,
            ],
            [
                'question' => $this->pull('question'),
                'answer' => $this->pull('answer'),
                'is_published' => $this->pull('is_published'),
            ]
        );

        Flux::modal('create-faq')->close();

        Flux::toast(
            heading: 'Manejo de Preguntas Frecuentes',
            text: 'Se creo el registro correctamente',
            variant: 'success',
        );
    }

    public function edit(FrequentlyAskedQuestion $faq)
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->is_published = $faq->is_published;
        $this->faq = $faq;

        $this->modal('create-faq')->show();
    }

    public function delete(FrequentlyAskedQuestion $faq)
    {
        abort_if(! auth()->user()->hasRole(RolesEnum::SUPER_ADMIN->value), 403);

        $faq->delete();
    }

    public function render()
    {
        $faqs = FrequentlyAskedQuestion::latest()->paginate(8);

        return view('livewire.admin.faqs.index', compact('faqs'));
    }

    protected function rules(): array
    {
        return [
            'question.*' => 'required|string|max:300',
            'answer.*' => 'required|string|max:600',
            'is_published' => 'boolean',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'question.es' => 'pregunta (es)',
            'question.en' => 'pregunta (en)',
            'answer.es' => 'respuesta (es)',
            'answer.en' => 'respuesta (en)',
            'is_published' => 'publicado',
        ];
    }
}
