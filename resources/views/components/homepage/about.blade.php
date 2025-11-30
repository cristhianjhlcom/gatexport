@props([
    'about' => [],
    'general_information' => [],
])

<section>
  <div class="container space-y-8">
    <div class="relative flex flex-col-reverse items-start gap-4 md:flex-row">
      <x-common.separator-line class="absolute hidden lg:right-[15%] lg:top-[9.5%] lg:flex lg:w-[500px]" />
      <div class="flex w-full flex-col items-start justify-center gap-4 md:w-1/2 md:flex-row">
        @if ($about && Storage::disk('public')->exists($about['home_first_image']))
          <div class="z-20 w-full translate-y-4 transform overflow-hidden rounded-sm md:h-[500px] md:w-1/2">
            <img
              alt="{{ __('pages.home.about.title') }}"
              class="aspect-square h-full w-full object-cover"
              src="{{ Storage::disk('public')->url($about['home_first_image']) }}"
            >
          </div>
        @endif
        @if ($about && Storage::disk('public')->exists($about['home_second_image']))
          <div class="z-20 hidden h-full overflow-hidden rounded-sm md:block md:h-[500px] md:w-1/2">
            <img
              alt="{{ __('pages.home.about.title') }}"
              class="aspect-square h-full w-full object-cover"
              src="{{ Storage::disk('public')->url($about['home_second_image']) }}"
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
        </div>
      @endif
    </div>
  </div>
</section>
