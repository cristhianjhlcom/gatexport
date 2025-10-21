@if ($about['translations']['commitment'])
  <section class="w-full bg-cover bg-center py-10 md:py-20"
    style="background-image: url({{ Storage::disk('public')->url($about['commitment_background_image']) }})"
  >
    <div class="container flex flex-col items-start justify-between gap-10 md:flex-row md:items-center">
      <header class="w-full space-y-10 text-left text-white md:w-1/2 md:text-center dark:text-white">
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
          <div class="space-y-4 text-sm leading-relaxed md:text-base">{!! $about['translations']['commitment']['description'] !!}</div>
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
