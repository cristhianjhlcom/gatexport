@php
  $quality = $about['translations']['quality'];
  $image = $about['quality_main_image'];
@endphp

@if ($quality)
  <section class="bg-primary-50 dark:bg-primary-50 w-full pb-10 pt-20">
    <div class="container flex items-start justify-between gap-10">
      @if ($image)
        <div class="flex flex-1 justify-start overflow-hidden rounded-sm">
          <img
            alt="{{ $quality['title'] }}"
            class="z-20 aspect-square rounded-sm"
            src="{{ Storage::disk('public')->url($image) }}"
          />
        </div>
      @endif

      <header class="relative w-1/2 space-y-10">
        @if ($quality['title'])
          @php
            $headingParts = explode(' ', $quality['title']);
          @endphp

          @if (count($headingParts) > 3)
            <h2 class="text-primary-500 text-4xl font-extrabold italic leading-tight">
              {{ implode(' ', array_slice($headingParts, 0, 3)) }}
            </h2>
            <x-common.separator-line
              class="absolute hidden lg:right-[10%] lg:top-[15%] lg:flex lg:w-[700px]"
              color="border-primary-500"
              pointColor="bg-primary-500"
            />
            <h2 class="text-primary-500 ml-20 text-4xl font-extrabold italic leading-tight">
              {{ implode(' ', array_slice($headingParts, 3)) }}
            </h2>
          @else
            <h2 class="text-primary-500 text-4xl font-extrabold italic leading-tight">
              {{ $quality['title'] }}
            </h2>
          @endif
        @endif

        @if ($quality['description'])
          <div class="space-y-4 leading-relaxed">{!! $quality['description'] !!}</div>
        @endif
      </header>
    </div>
  </section>
@endif
