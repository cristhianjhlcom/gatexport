<section class="relative overflow-clip bg-white py-10 md:py-0">
  <div class="mx-auto grid grid-cols-1 place-content-center items-center md:grid-cols-2">
    {{-- Imagen a la izquierda --}}
    <div class="relative w-full md:h-[650px]">
      <img
        alt="{{ __('pages.about.title') }}"
        class="object-bottom-left absolute inset-0 hidden h-full w-full object-contain md:block md:object-cover"
        src="{{ Storage::disk('public')->url($about['hero_image']) }}"
      >
    </div>

    {{-- Contenido a la derecha --}}
    <div class="left-0 top-3 space-y-4 px-4 md:absolute md:left-[800px] md:top-[100px] md:px-0">
      <header>
        @php
          $headingParts = explode(' ', __('pages.about.title'));
        @endphp

        @if (count($headingParts) > 1)
          <h1 class="text-primary-400 text-5xl font-extrabold italic leading-tight md:text-7xl">
            {{ implode(' ', array_slice($headingParts, 0, 1)) }}
          </h1>
          <x-common.separator-line
            class="absolute hidden lg:right-[20%] lg:top-[22%] lg:flex lg:w-[700px]"
            color="border-primary-400"
            pointColor="bg-primary-400"
          />
          <h1 class="text-primary-400 md:ml-50 ml-30 text-5xl font-extrabold italic leading-tight md:text-7xl">
            {{ implode(' ', array_slice($headingParts, 1)) }}
          </h1>
        @else
          <h1 class="text-primary-400 text-5xl font-extrabold italic leading-tight md:text-7xl">
            {{ __('pages.about.title') }}
          </h1>
        @endif
      </header>

      @if (isset($about['translations']['mainHistory']))
        <div
          class="w-full max-w-[700px] space-y-4 rounded-sm bg-white/35 p-2 text-sm font-medium leading-relaxed text-gray-900 md:w-[700px] md:bg-transparent md:p-0 md:text-base"
        >
          {!! $about['translations']['mainHistory'] !!}
        </div>
      @endif
    </div>
  </div>
</section>
