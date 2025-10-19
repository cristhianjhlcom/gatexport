<section class="relative overflow-hidden bg-white">
  <div class="mx-auto grid grid-cols-1 items-center md:grid-cols-2">

    {{-- Imagen a la izquierda --}}
    <div class="relative h-[500px] w-full md:h-[650px]">
      <img
        alt="Palo Santo en manos"
        class="absolute inset-0 h-full w-full object-cover object-left-bottom"
        src="{{ Storage::disk('public')->url($about['hero_image']) }}"
      >
    </div>

    {{-- Contenido a la derecha --}}
    <div class="absolute left-[800px] top-[100px] space-y-4">
      <header>
        @php
          $headingParts = explode(' ', __('pages.about.title'));
        @endphp

        @if (count($headingParts) > 1)
          <h1 class="text-primary-400 text-7xl font-extrabold italic leading-tight">
            {{ implode(' ', array_slice($headingParts, 0, 1)) }}
          </h1>
          <x-common.separator-line
            class="absolute hidden lg:right-[20%] lg:top-[22%] lg:flex lg:w-[700px]"
            color="border-primary-400"
            pointColor="bg-primary-400"
          />
          <h1 class="text-primary-400 ml-50 text-7xl font-extrabold italic leading-tight">
            {{ implode(' ', array_slice($headingParts, 1)) }}
          </h1>
        @else
          <h1 class="text-primary-400 text-7xl font-extrabold italic leading-tight">
            {{ __('pages.about.title') }}
          </h1>
        @endif
      </header>

      @if (isset($about['translations']['mainHistory']))
        <div class="w-full space-y-4 text-base leading-relaxed text-gray-700 md:w-[700px]">
          {!! $about['translations']['mainHistory'] !!}
        </div>
      @endif
    </div>
  </div>
</section>
