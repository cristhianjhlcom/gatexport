@php
  $quality = $about['translations']['quality'];
  $image = $about['quality_main_image'];
@endphp

@if ($quality)
  <section class="bg-primary-50 dark:bg-primary-50 w-full pb-10 pt-10 md:pt-20">
    <div class="container flex flex-col items-start justify-between gap-10 md:flex-row">
      @if ($image)
        <div class="order-2 flex flex-1 justify-start overflow-hidden rounded-sm md:order-1">
          <img
            alt="{{ $quality['title'] }}"
            class="z-20 aspect-square rounded-sm"
            src="{{ Storage::disk('public')->url($image) }}"
          />
        </div>
      @endif

      <div class="relative order-1 w-full space-y-6 md:order-2 md:w-1/2 md:space-y-10">
        <header class="space-y-2">
          @if ($quality['title'])
            @php
              $headingParts = explode(' ', $quality['title']);
            @endphp

            @if (count($headingParts) > 3)
              <h2
                class="text-primary-500 dark:text-primary-500 text-3xl font-extrabold italic leading-tight md:text-5xl">
                {{ implode(' ', array_slice($headingParts, 0, 3)) }}
              </h2>
              <x-common.separator-line
                class="absolute hidden lg:right-[10%] lg:top-[15%] lg:flex lg:w-[700px]"
                color="border-primary-500"
                pointColor="bg-primary-500"
              />
              <h2
                class="text-primary-500 dark:text-primary-500 m-0 text-3xl font-extrabold italic leading-tight md:ml-20 md:text-5xl"
              >
                {{ implode(' ', array_slice($headingParts, 3)) }}
              </h2>
            @else
              <h2
                class="text-primary-500 dark:text-primary-500 text-3xl font-extrabold italic leading-tight md:text-5xl"
              >
                {{ $quality['title'] }}
              </h2>
            @endif
          @endif
        </header>

        @if ($quality['description'])
          <div class="space-y-4 leading-relaxed text-gray-900 dark:text-gray-900">
            {!! $quality['description'] !!}
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
