@props([
    'about' => [],
    'general_information' => [],
])

<article class="bg-primary-50 py-10 md:py-16 lg:py-20" id="about-us">
  <div class="container space-y-8 md:space-y-12">
    <div class="flex flex-col-reverse items-center gap-8 md:flex-row md:gap-12">
      <div class="flex w-full flex-col items-center justify-center gap-4 md:w-1/2 md:flex-row">
        <img
          alt="Nuestra Historia"
          class="h-[300px] w-full rounded-lg object-cover md:h-[400px] md:w-1/2"
          src="https://placehold.net/400x600.png"
        >
        <img
          alt="Nuestra Historia"
          class="mt-4 h-[300px] w-full rounded-lg object-cover md:mt-20 md:h-[400px] md:w-1/2"
          src="https://placehold.net/400x600.png"
        >
      </div>
      <div class="w-full space-y-2 md:w-1/2 md:space-y-4">
        <flux:heading
          class="text-primary-700"
          level="2"
          size="xl"
        >Nuestra Historia</flux:heading>
        <flux:text>
          {{ $general_information['translations']['company_short_description'] }}
        </flux:text>

        <div class="flex flex-col gap-4 sm:flex-row">
          <flux:button
            class="w-full sm:w-auto"
            type="button"
            variant="primary"
          >
            Contáctanos
          </flux:button>
          <flux:button
            class="w-full sm:w-auto"
            type="button"
            variant="ghost"
          >
            Productos
          </flux:button>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center gap-8 md:flex-row md:gap-12">
      <div class="w-full space-y-4 md:w-1/2 md:space-y-6">
        <div class="space-y-2">
          <flux:heading
            class="text-primary-700"
            level="2"
            size="xl"
          >Nuestra Misión</flux:heading>
          <flux:text>
            {!! $about['translations']['mission'] !!}
          </flux:text>
        </div>

        <div class="space-y-2">
          <flux:heading
            class="text-primary-700"
            level="2"
            size="xl"
          >Nuestra Visión</flux:heading>
          <flux:text>
            {!! $about['translations']['vision'] !!}
          </flux:text>
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <img
          alt="Nuestra Historia"
          class="h-[300px] w-full rounded-lg object-cover md:h-[400px]"
          src="https://placehold.net/5.png"
        >
      </div>
    </div>
  </div>
</article>
