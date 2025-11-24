@php
  $data = $about['translations']['certification'];
  $mainImage = $about['certification_main_image'];
  $secondaryImage = $about['certification_secondary_image'];
@endphp

@if ($data)
  <section class="bg-primary-50 dark:bg-primary-50 w-full pb-20 pt-5 md:pt-10">
    <div class="container flex flex-col items-start justify-between gap-10 md:flex-row">
      <header class="relative w-full space-y-10 md:w-1/2">
        @if ($data['title'])
          <div class="space-y-10">
            <h2 class="text-primary-500 dark:text-primary-500 text-3xl font-extrabold italic leading-tight md:leading-relaxed">
              {{ $data['title'] }}
            </h2>
            <x-common.separator-line class="absolute hidden lg:left-[0%] lg:top-[16%] lg:flex lg:w-[700px]" color="border-primary-500"
              pointColor="bg-primary-500" />
          </div>
        @endif

        @if ($data['description'])
          <div class="space-y-4 text-left leading-relaxed text-gray-900 md:text-right dark:text-gray-900">
            {!! $data['description'] !!}
          </div>
        @endif
      </header>

      <div class="flex flex-1 justify-start gap-4 rounded-sm">
        @if ($mainImage)
          <img alt="{{ $data['title'] }}" class="z-20 aspect-auto w-1/2 translate-y-6 transform rounded-sm md:w-full"
            src="{{ Storage::disk('public')->url($mainImage) }}" />
        @endif

        @if ($secondaryImage)
          <img alt="{{ $data['title'] }}" class="z-20 aspect-auto w-1/2 rounded-sm md:w-full"
            src="{{ Storage::disk('public')->url($secondaryImage) }}" />
        @endif
      </div>
    </div>
  </section>
@endif
