@if ($about['translations']['commitment'])
  <section class="w-full bg-cover bg-center py-20"
    style="background-image: url({{ Storage::disk('public')->url($about['commitment_background_image']) }})"
  >
    <div class="container flex items-center justify-between gap-10">
      <header class="w-1/2 space-y-10 text-center text-white dark:text-white">
        @if ($about['translations']['commitment']['title'])
          <div class="flex flex-col items-center justify-center gap-4">
            <h2 class="text-3xl font-extrabold capitalize leading-tight">
              {{ $about['translations']['commitment']['title'] }}</h2>
            <x-common.separator-line
              class="w-full max-w-[400px]"
              color="border-white"
              pointColor="bg-white"
            />
          </div>
        @endif

        @if ($about['translations']['commitment']['description'])
          <div class="space-y-4 leading-relaxed">{!! $about['translations']['commitment']['description'] !!}</div>
        @endif
      </header>

      @if ($about['commitment_main_image'])
        <div class="flex flex-1 justify-end overflow-hidden rounded-sm">
          <img
            alt="{{ $about['translations']['commitment']['title'] }}"
            class="aspect-square rounded-sm"
            src="{{ Storage::disk('public')->url($about['commitment_main_image']) }}"
          />
        </div>
      @endif
    </div>
  </section>
@endif
