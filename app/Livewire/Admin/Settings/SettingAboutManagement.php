<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

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

    public $newQualityMainImage;

    public $newCertificationMainImage;

    public $newCertificationSecondaryImage;

    public $newHistoryMainImage;

    public $newHistoryBackgroundImage;

    public $newValuesIcons = [
        'es' => [],
        'en' => [],
    ];

    #[Validate]
    public $youtubeVideoId = '';

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
            'quality' => [
                'title' => '',
                'description' => '',
            ],
            'certification' => [
                'title' => '',
                'description' => '',
            ],
            'ourHistory' => [
                'title' => '',
                'description' => '',
            ],
            'values' => [
                'items' => [],
                'mission' => [
                    'title' => '',
                    'description' => '',
                ],
                'vision' => [
                    'title' => '',
                    'description' => '',
                ],
            ],
            'contact' => [
                'title' => '',
                'description' => '',
            ],
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
            'quality' => [
                'title' => '',
                'description' => '',
            ],
            'certification' => [
                'title' => '',
                'description' => '',
            ],
            'ourHistory' => [
                'title' => '',
                'description' => '',
            ],
            'values' => [
                'items' => [],
                'mission' => [
                    'title' => '',
                    'description' => '',
                ],
                'vision' => [
                    'title' => '',
                    'description' => '',
                ],
            ],
            'contact' => [
                'title' => '',
                'description' => '',
            ],
        ],
        'hero_image' => '',
        'home_first_image' => '',
        'home_second_image' => '',
        'commitment_main_image' => '',
        'commitment_background_image' => '',
        'quality_main_image' => '',
        'certification_main_image' => '',
        'certification_secondary_image' => '',
        'history_main_image' => '',
        'history_background_image' => '',
    ];

    protected $rules = [
        'about.es.home.history' => 'required|string|max:2000',
        'about.es.mainHistory' => 'required|string|max:2000',
        'about.es.commitment.title' => 'required|string|max:150',
        'about.es.commitment.description' => 'required|string|max:2000',
        'about.es.quality.title' => 'required|string|max:150',
        'about.es.quality.description' => 'required|string|max:2000',
        'about.es.certification.title' => 'required|string|max:150',
        'about.es.certification.description' => 'required|string|max:2000',
        'about.es.ourHistory.title' => 'required|string|max:150',
        'about.es.ourHistory.description' => 'required|string|max:2000',
        'about.es.values.items.*.description' => 'nullable|string|max:1000',
        'about.es.values.items.*.icon' => 'nullable',
        'about.es.values.mission.title' => 'required|string|max:100',
        'about.es.values.mission.description' => 'required|string|max:2000',
        'about.es.values.vision.title' => 'required|string|max:100',
        'about.es.values.vision.description' => 'required|string|max:2000',
        'about.es.contact.title' => 'required|string|max:100',
        'about.es.contact.description' => 'required|string|max:2000',

        'about.en.home.history' => 'required|string|max:2000',
        'about.en.mainHistory' => 'required|string|max:2000',
        'about.en.commitment.title' => 'required|string|max:150',
        'about.en.commitment.description' => 'required|string|max:2000',
        'about.en.quality.title' => 'required|string|max:150',
        'about.en.quality.description' => 'required|string|max:2000',
        'about.en.certification.title' => 'required|string|max:150',
        'about.en.certification.description' => 'required|string|max:2000',
        'about.en.ourHistory.title' => 'required|string|max:150',
        'about.en.ourHistory.description' => 'required|string|max:2000',
        'about.en.values.items.*.description' => 'nullable|string|max:1000',
        'about.en.values.items.*.icon' => 'nullable',
        'about.en.values.mission.title' => 'required|string|max:100',
        'about.en.values.mission.description' => 'required|string|max:2000',
        'about.en.values.vision.title' => 'required|string|max:100',
        'about.en.values.vision.description' => 'required|string|max:2000',
        'about.es.contact.title' => 'required|string|max:100',
        'about.es.contact.description' => 'required|string|max:2000',

        'youtubeVideoId' => 'nullable|string|min:7|max:30',
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

        'newQualityMainImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=500,height=500',
        ],

        'newCertificationMainImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=300,height=500',
        ],

        'newCertificationSecondaryImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=300,height=500',
        ],

        'newHistoryMainImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=500,height=500',
        ],

        'newHistoryBackgroundImage' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:width=900,height=500',
        ],

        'newValuesIcons.*.*' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,svg',
            'max:1024',
            'dimensions:width=50,height=50',
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

    public function updatedNewValuesIcons($value, $key)
    {
        $parts = explode('.', $key);
        $locale = $parts[0];
        $index = $parts[1];

        if (isset($this->about[$locale]['values']['items'][$index])) {
            $this->about[$locale]['values']['items'][$index] = $value;
        }
    }

    public function addValue($locale = 'es')
    {
        $this->about[$locale]['values']['items'][] = [
            'description' => '',
            'image' => '',
        ];
    }

    public function removeValue($locale, $index)
    {
        unset($this->about[$locale]['values']['items'][$index]);
        unset($this->newValuesIcons[$locale][$index]);

        $this->about[$locale]['values']['items'] = array_values($this->about[$locale]['values']['items']);
        $this->newValuesIcons[$locale] = array_values($this->newValuesIcons[$locale]);
    }

    public function save()
    {
        $this->validate();

        $this->services->save([
            'about' => $this->about,
            'youtube_video_id' => $this->youtubeVideoId,
            'new_hero_image' => $this->newHeroImage,
            'new_home_first_image' => $this->newHomeFirstImage,
            'new_home_second_image' => $this->newHomeSecondImage,
            'new_commitment_main_image' => $this->newCommitmentMainImage,
            'new_commitment_background_image' => $this->newCommitmentBackgroundImage,
            'new_quality_main_image' => $this->newQualityMainImage,
            'new_certification_main_image' => $this->newCertificationMainImage,
            'new_certification_secondary_image' => $this->newCertificationSecondaryImage,
            'new_history_main_image' => $this->newHistoryMainImage,
            'new_history_background_image' => $this->newHistoryBackgroundImage,
            'new_values_icons' => $this->newValuesIcons,
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
