@props([
    'company_services' => [],
])

@if (count($company_services) > 0)
  <section class="py-6 md:py-10 lg:py-14" id="services">
    <div class="container">
      <div class="flex items-start justify-start gap-4 md:flex-row md:gap-12">

        <div class="z-10 hidden min-h-[1175px] w-1/2 rounded-sm sm:flex">
          @if ($company_services)
            <img alt="{{ __('pages.home.services.title') }}"
              src="{{ Storage::disk('public')->url($company_services['main_image']) }}"
            >
          @endif
        </div>

        <div class="w-full justify-start space-y-4 md:w-1/2 md:space-y-6">

          @if (isset($company_services['heading']))
            <header class="relative hidden flex-col space-y-4 lg:flex">
              @php
                $headingParts = explode(' ', $company_services['heading']);
              @endphp
              @if (count($headingParts) > 3)
                <x-common.title
                  class="text-center sm:text-left"
                  level="2"
                  size="title"
                  weight="font-extrabold"
                >
                  {{ implode(' ', array_slice($headingParts, 0, 3)) }}
                </x-common.title>
                <x-common.separator-line class="absolute hidden lg:right-[5%] lg:top-[45.5%] lg:flex lg:w-[700px]" />
                <x-common.title
                  class="text-center sm:text-left"
                  level="2"
                  size="title"
                  weight="font-extrabold"
                >
                  {{ implode(' ', array_slice($headingParts, 3)) }}
                </x-common.title>
              @else
                <x-common.title
                  class="text-center sm:text-left"
                  level="2"
                  size="title"
                  weight="font-extrabold"
                >
                  {{ $company_services['heading'] }}
                </x-common.title>
              @endif
              {{-- <x-common.title
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
            </x-common.title> --}}
            </header>
          @endif

          @if (isset($company_services['heading']))
            <header class="relative flex flex-col space-y-4 lg:hidden">
              <x-common.title
                class="text-center sm:text-left"
                level="2"
                size="title"
                weight="font-extrabold"
              >
                {{ $company_services['heading'] }}
              </x-common.title>
              <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
            </header>
          @endif

          @if (isset($company_services['description']))
            <div class="space-y-4">
              <div class="space-y-4 text-[17px] font-light text-gray-900">
                {!! $company_services['description'] !!}
              </div>

              @if (isset($company_services['important_message']))
                <p class="text-primary-400 dark:text-primary-400 text-[17px] font-extrabold">
                  {{ $company_services['important_message'] }}</p>
              @endif
            </div>
          @endif

          @if ($company_services)
            <x-common.accordion>
              @foreach ($company_services['services'] as $service)
                @if ($loop->first)
                  <x-common.accordion.item
                    :content="$service['description']"
                    :icon="$service['icon']"
                    :open="true"
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

          @if (isset($company_services['disclaimer']))
            <small
              class="text-[17px] font-light text-gray-900 dark:text-gray-900">{{ $company_services['disclaimer'] }}</small>
          @endif

        </div>
      </div>
    </div>
  </section>
@endif
