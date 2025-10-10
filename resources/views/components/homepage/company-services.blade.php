@props([
    'company_services' => [],
])

@if (count($company_services) > 0)
  <section class="py-6 md:py-10 lg:py-14" id="services">
    <div class="container">
      <div class="flex items-start justify-start gap-4 md:flex-row md:gap-12">

        <div
          class="z-10 hidden max-h-[800px] w-1/2 overflow-hidden rounded-sm sm:flex sm:items-center sm:justify-center">
          @if ($company_services)
            <img
              alt="{{ __('pages.home.services.title') }}"
              class="object-contain"
              src="{{ Storage::disk('public')->url($company_services['main_image']) }}"
            >
          @endif
        </div>

        <div class="w-1/2 justify-start space-y-4 md:space-y-6">

          <header class="relative hidden flex-col space-y-4 lg:flex">
            <x-common.title
              class="text-center sm:text-left"
              level="2"
              size="title"
              weight="font-extrabold"
            >
              Servicios especializados para
            </x-common.title>
            <x-common.separator-line class="absolute hidden lg:right-[5%] lg:top-[45.5%] lg:flex lg:w-[700px]" />
            <x-common.title
              class="text-center sm:text-left"
              level="2"
              size="title"
              weight="font-extrabold"
            >
              Importadores de Palo Santo
            </x-common.title>
          </header>

          <header class="relative flex flex-col space-y-4 lg:hidden">
            <x-common.title
              class="text-center sm:text-left"
              level="2"
              size="title"
              weight="font-extrabold"
            >
              Servicios especializados para importadores de Palo Santo
            </x-common.title>
            <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
          </header>

          @if ($company_services)
            <x-common.accordion>
              @foreach ($company_services['services'] as $service)
                @if ($loop->first)
                  <x-common.accordion.item
                    :content="$service['description']"
                    :icon="$service['icon']"
                    :subtitle="$service['subtitle'] ?? 'Subtítulo Falso'"
                    :title="$service['title']"
                  />
                @else
                  <x-common.accordion.item
                    :content="$service['description']"
                    :icon="$service['icon']"
                    :subtitle="$service['subtitle'] ?? 'Subtítulo Falso'"
                    :title="$service['title']"
                  />
                @endif
              @endforeach
            </x-common.accordion>
          @endif

        </div>
      </div>
    </div>
  </section>
@endif
