@props([
    'about' => [],
    'general_information' => [],
])

<article class="bg-primary-50 dark:bg-primary-50 py-10 md:py-16 lg:py-20" id="about-us">
  <div class="container space-y-8 md:space-y-12">
    <div class="relative flex flex-col-reverse items-start gap-8 md:flex-row md:gap-12">

      <x-common.separator-line class="absolute hidden lg:right-[15%] lg:top-[9.5%] lg:flex lg:w-[500px]" />

      <div class="flex w-full flex-col items-start justify-center gap-4 md:w-1/2 md:flex-row">
        @if ($about && Storage::disk('public')->exists($about['first_image']))
          <div class="z-20 translate-y-4 transform overflow-hidden rounded-sm md:h-[500px] md:w-1/2">
            <img
              alt="{{ __('pages.home.about.title') }}"
              class="aspect-square h-full w-full object-cover"
              src="{{ Storage::disk('public')->url($about['first_image']) }}"
            >
          </div>
        @endif
        @if ($about && Storage::disk('public')->exists($about['second_image']))
          <div class="z-20 hidden h-full overflow-hidden rounded-sm md:block md:h-[500px] md:w-1/2">
            <img
              alt="{{ __('pages.home.about.title') }}"
              class="aspect-square h-full w-full object-cover"
              src="{{ Storage::disk('public')->url($about['second_image']) }}"
            >
          </div>
        @endif
      </div>

      @if ($general_information)
        <div class="w-full space-y-4 md:w-1/2 md:space-y-6">
          <x-common.title
            level="2"
            size="title"
            variant="primary"
            weight="font-extrabold"
          >
            {{ __('pages.home.about.title') }}
          </x-common.title>

          <div class="space-y-4 text-gray-900">
            {!! $general_information['translations']['company_description'] !!}
          </div>

          {{-- NOTE: Por rediseño esta sección se oculta temporalmente
          <div class="flex flex-col gap-4 sm:flex-row">
            <flux:button
              class="w-full sm:w-auto"
              href="{{ route('about-us.index') }}"
              type="button"
              variant="primary"
            >
              {{ __('pages.home.about.full_history') }}
            </flux:button>
          </div>
          --}}
        </div>
      @endif
    </div>

    {{-- NOTE: Por rediseño esta sección se oculta temporalmente
    <div class="flex flex-col items-center gap-8 md:flex-row md:gap-12">
      <div class="w-full space-y-4 md:w-1/2 md:space-y-6">

        @if ($about)
          <div class="space-y-2">
            <x-heading
              level="3"
              size="lg"
              weight="black"
            >
              {{ __('pages.home.about.mission') }}
            </x-heading>

            <flux:text>
              {!! $about['translations']['mission'] !!}
            </flux:text>
          </div>
        @endif

        @if ($about)
          <div class="space-y-2">
            <x-heading
              level="3"
              size="lg"
              weight="black"
            >
              {{ __('pages.home.about.vision') }}
            </x-heading>
            <flux:text>
              {!! $about['translations']['vision'] !!}
            </flux:text>
          </div>
        @endif

      </div>

      @if ($about && $about['youtube_video_id'])
        <div class="w-full md:w-1/2">
          <lite-youtube videoid="{{ $about['youtube_video_id'] }}"></lite-youtube>
        </div>
      @endif

    </div>
    --}}
  </div>
</article>
