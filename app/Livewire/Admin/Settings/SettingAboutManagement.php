<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Services\AboutUsSettingService;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
final class SettingAboutManagement extends Component
{
    use WithFileUploads;

    #[Validate]
    public $newHomeFirstImage;

    public $newHomeSecondImage;

    public $newHeroImage;

    public $newCommitmentMainImage;

    public $newCommitmentBackgroundImage;

    #[Validate]
    public $about = [
        'es' => [
            'home' => [
                'history' => '',
            ],
            'mainHistory' => '',
            'commitment' => [
                'title' => '',
                'description' => '',
            ],
            'mission' => '',
            'vision' => '',
        ],
        'en' => [
            'home' => [
                'history' => '',
            ],
            'mainHistory' => '',
            'commitment' => [
                'title' => '',
                'description' => '',
            ],
            'mission' => '',
            'vision' => '',
        ],

        'home_first_image' => '',
        'home_second_image' => '',
        'youtube_video_id' => '',
    ];

    protected $rules = [
        'about.es.home.history' => 'required|string|max:2000',
        'about.es.mainHistory' => 'required|string|max:2000',
        'about.es.commitment.title' => 'required|string|max:150',
        'about.es.commitment.description' => 'required|string|max:2000',
        'about.es.mission' => 'required|string|max:2000',
        'about.es.vision' => 'required|string|max:2000',

        'about.en.home.history' => 'required|string|max:2000',
        'about.en.mainHistory' => 'required|string|max:2000',
        'about.es.commitment.title' => 'required|string|max:150',
        'about.es.commitment.description' => 'required|string|max:2000',
        'about.en.mission' => 'required|string|max:2000',
        'about.en.vision' => 'required|string|max:2000',
        'about.youtube_video_id' => 'nullable|string|min:7|max:30',

        'newHeroImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=900,height=700',
        ],

        'newHomeFirstImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:min_width=300,min_height=450,max_width=300,max_height=450',
        ],

        'newHomeSecondImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:min_width=300,min_height=450,max_width=300,max_height=450',
        ],

        'newCommitmentMainImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=500,height=500',
        ],

        'newCommitmentBackgroundImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=900,height=500',
        ],
    ];

    protected AboutUsSettingService $services;

    public function boot()
    {
        $this->services = app(AboutUsSettingService::class);
    }

    public function mount()
    {
        $this->about = $this->services->load();
    }

    public function save()
    {
        $this->validate();

        $this->services->save([
            'about' => $this->about,
            'new_hero_image' => $this->newHeroImage,
            'new_home_first_image' => $this->newHomeFirstImage,
            'new_home_second_image' => $this->newHomeSecondImage,
            'new_commitment_main_image' => $this->newCommitmentMainImage,
            'new_commitment_background_image' => $this->newCommitmentBackgroundImage,
        ]);

        Flux::toast(
            heading: 'Configuración actualizada',
            text: 'La configuración ha sido actualizada correctamente',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.about.index')
            ->with([
                'about' => $this->about,
            ])
            ->title('Nosotros | Settings | Management');
    }
}
