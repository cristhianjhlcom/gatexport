@php
  $data = $about['translations']['ourHistory'];
  $mainImage = $about['history_main_image'];
  $backgroundImage = $about['history_background_image'];
@endphp

@if ($data)
  <section class="w-full bg-cover bg-center py-20"
    style="background-image: url({{ Storage::disk('public')->url($backgroundImage) }})"
  >
    <div class="container flex items-center justify-between gap-10">
      @if ($mainImage)
        <div class="flex flex-1 justify-start rounded-sm">
          <img
            alt="{{ $data['title'] }}"
            class="aspect-square rounded-sm shadow-xl"
            src="{{ Storage::disk('public')->url($mainImage) }}"
          />
        </div>
      @endif

      <header class="w-1/2 space-y-10 text-center text-white dark:text-white">
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
          <div class="space-y-4 leading-relaxed">{!! $data['description'] !!}</div>
        @endif
      </header>
    </div>
  </section>
@endif
