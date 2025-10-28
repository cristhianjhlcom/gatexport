@php
  $data = $about['translations']['ourHistory'];
  $mainImage = $about['history_main_image'];
  $backgroundImage = $about['history_background_image'];
@endphp

@if ($data)
  <section class="w-full bg-cover bg-center py-10 md:py-20"
    style="background-image: url({{ Storage::disk('public')->url($backgroundImage) }})"
  >
    <div class="container flex flex-col items-start justify-between gap-10 md:flex-row md:items-center">
      @if ($mainImage)
        <div class="order-2 flex flex-1 justify-start rounded-sm md:order-1">
          <img
            alt="{{ $data['title'] }}"
            class="aspect-auto rounded-sm object-contain shadow-xl"
            src="{{ Storage::disk('public')->url($mainImage) }}"
          />
        </div>
      @endif

      <header class="order-1 w-full space-y-10 text-left text-white md:order-2 md:w-1/2 md:text-center dark:text-white">
        @if ($about['translations']['commitment']['title'])
          <div class="flex flex-col items-center justify-center gap-4">
            <h2 class="text-3xl font-extrabold capitalize leading-tight">
              {{ $data['title'] }}
            </h2>
            <x-common.separator-line
              class="w-full max-w-[400px]"
              color="border-white"
              pointColor="bg-white"
            />
          </div>
        @endif

        @if ($data['description'])
          <div class="space-y-4 text-sm leading-relaxed md:text-base">{!! $data['description'] !!}</div>
        @endif
      </header>
    </div>
  </section>
@endif
