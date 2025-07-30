@props([
    'about' => [],
    'general_information' => [],
])

<article class="bg-primary-50 pb-10 pt-0 md:pb-16 lg:pb-20" id="about-us">
  <div class="container space-y-8 md:space-y-12">
    <div class="flex flex-col-reverse items-center gap-8 md:flex-row md:gap-12">
      <div class="flex w-full flex-col items-center justify-center gap-4 md:w-1/2 md:flex-row">
        @if ($about && Storage::disk('public')->exists($about['first_image']))
          <img
            alt="{{ __('pages.home.about.title') }}"
            class="mt-0 aspect-square h-auto w-full rounded-sm object-cover md:mt-20 md:h-[500px] md:w-1/2"
            src="{{ Storage::disk('public')->url($about['first_image']) }}"
          >
        @endif
        @if ($about && Storage::disk('public')->exists($about['second_image']))
          <img
            alt="{{ __('pages.home.about.title') }}"
            class="hidden aspect-square h-[500px] w-full rounded-sm object-cover md:block md:h-[500px] md:w-1/2"
            src="{{ Storage::disk('public')->url($about['second_image']) }}"
          >
        @endif
      </div>
      <div class="w-full space-y-2 md:w-1/2 md:space-y-4">
        <x-heading
          level="2"
          size="xl"
          weight="black"
        >
          {{ __('pages.home.about.title') }}
        </x-heading>

        @if ($general_information)
          <flux:text>
            {{ $general_information['translations']['company_short_description'] }}
          </flux:text>
        @endif

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
      </div>
    </div>

    <div class="flex flex-col items-center gap-8 md:flex-row md:gap-12">
      <div class="w-full space-y-4 md:w-1/2 md:space-y-6">
        <div class="space-y-2">
          <x-heading
            level="3"
            size="lg"
            weight="black"
          >
            {{ __('pages.home.about.mission') }}
          </x-heading>

          @if ($about)
            <flux:text>
              {!! $about['translations']['mission'] !!}
            </flux:text>
          @endif
        </div>

        <div class="space-y-2">
          <x-heading
            level="3"
            size="lg"
            weight="black"
          >
            {{ __('pages.home.about.vision') }}
          </x-heading>

          @if ($about)
            <flux:text>
              {!! $about['translations']['vision'] !!}
            </flux:text>
          @endif

        </div>
      </div>

      @if ($about && $about['youtube_video_id'])
        <div class="w-full md:w-1/2">
          <lite-youtube videoid="{{ $about['youtube_video_id'] }}"></lite-youtube>
        </div>
      @endif

    </div>
  </div>
</article>
