@props([
    'about' => [],
    'general_information' => [],
])

<article class="bg-primary-50 py-10 md:py-16 lg:py-20" id="about-us">
  <div class="container space-y-8 md:space-y-12">
    <div class="flex flex-col-reverse items-center gap-8 md:flex-row md:gap-12">
      <div class="flex w-full flex-col items-center justify-center gap-4 md:w-1/2 md:flex-row">
        <img
          alt="Nuestra Historia"
          class="mt-0 aspect-square h-auto w-full rounded-sm object-cover md:mt-20 md:h-[500px] md:w-1/2"
          src="{{ Storage::disk('public')->url($about['first_image']) }}"
        >
        <img
          alt="Nuestra Historia"
          class="hidden aspect-square h-[500px] w-full rounded-sm object-cover md:block md:h-[500px] md:w-1/2"
          src="{{ Storage::disk('public')->url($about['second_image']) }}"
        >
      </div>
      <div class="w-full space-y-2 md:w-1/2 md:space-y-4">
        <x-heading
          level="2"
          size="xl"
          weight="black"
        >
          Nuestra Historia
        </x-heading>
        <flux:text>
          {{ $general_information['translations']['company_short_description'] }}
        </flux:text>

        <div class="flex flex-col gap-4 sm:flex-row">
          <flux:button
            class="w-full sm:w-auto"
            href="{{ route('about-us.index') }}"
            type="button"
            variant="primary"
          >
            Ver Historia Completa
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
            Nuestra Misión
          </x-heading>
          <flux:text>
            {!! $about['translations']['mission'] !!}
          </flux:text>
        </div>

        <div class="space-y-2">
          <x-heading
            level="3"
            size="lg"
            weight="black"
          >
            Nuestra Visión
          </x-heading>
          <flux:text>
            {!! $about['translations']['vision'] !!}
          </flux:text>
        </div>
      </div>
      @if ($about['youtube_video_id'])
        <div class="w-full md:w-1/2">
          <lite-youtube videoid="{{ $about['youtube_video_id'] }}"></lite-youtube>
        </div>
      @endif
    </div>
  </div>
</article>
