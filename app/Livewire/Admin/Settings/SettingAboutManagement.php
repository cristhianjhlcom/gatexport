<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Services\SettingManagementServices;
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
    public $new_first_image;

    #[Validate]
    public $new_second_image;

    #[Validate]
    public $about = [
        'es' => [
            'history' => '',
            'mission' => '',
            'vision' => '',
        ],
        'en' => [
            'history' => '',
            'mission' => '',
            'vision' => '',
        ],

        'first_image' => '',
        'second_image' => '',
        'youtube_video_id' => '',
    ];

    protected SettingManagementServices $services;

    protected $rules = [
        'about.es.history' => 'required|string|max:2000',
        'about.es.mission' => 'required|string|max:2000',
        'about.es.vision' => 'required|string|max:2000',
        'about.en.history' => 'required|string|max:2000',
        'about.en.mission' => 'required|string|max:2000',
        'about.en.vision' => 'required|string|max:2000',
        'about.youtube_video_id' => 'nullable|string|min:7|max:30',

        'new_first_image' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:min_width=500,min_height=500,max_width=1000,max_height=1000',
        ],
        'new_second_image' => [
            'nullable',
            'image',
            'mimes:png,jpg,jpeg,webp',
            'max:2048', // 2MB max
            'dimensions:min_width=500,min_height=500,max_width=1000,max_height=1000',
        ],
    ];

    public function boot()
    {
        $this->services = app(SettingManagementServices::class);
    }

    public function mount()
    {
        $this->about = $this->services->loadAbout();
    }

    public function save()
    {
        $this->validate();

        $this->services->saveAbout([
            'about' => $this->about,
            'new_first_image' => $this->new_first_image,
            'new_second_image' => $this->new_second_image,
        ]);

        Flux::toast(
            heading: __('Settings Updated'),
            text: __('Settings have been updated successfully.'),
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.admin.settings.about')
            ->with([
                'about' => Setting::get('about'),
            ])
            ->title('About | Settings | Management');
    }
}
