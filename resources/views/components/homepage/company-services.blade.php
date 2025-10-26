@props([
    'company_services' => [],
])

@php
  $data = $company_services['homepage'] ??= [];
  $services = $company_services['services'] ??= [];
@endphp

@if (count($data) > 0)
  <section class="py-6 md:py-10 lg:py-14" id="services">
    <div class="container">
      <div class="flex items-start justify-start gap-4 md:flex-row md:gap-12">

        <div class="z-10 hidden min-h-[1175px] w-1/2 rounded-sm sm:flex">
          @if ($data)
            <img alt="{{ __('pages.home.services.title') }}" src="{{ Storage::disk('public')->url($data['image']) }}">
          @endif
        </div>

        <div class="w-full justify-start space-y-4 md:w-1/2 md:space-y-6">
          @if (isset($data['heading']))
            <header class="relative hidden flex-col space-y-4 lg:flex">
              @php
                $headingParts = explode(' ', $data['heading']);
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
                  {{ $data['heading'] }}
                </x-common.title>
              @endif
            </header>
          @endif

          @if (isset($data['heading']))
            <header class="relative flex flex-col space-y-4 lg:hidden">
              <x-common.title
                class="text-center sm:text-left"
                level="2"
                size="title"
                weight="font-extrabold"
              >
                {{ $data['heading'] }}
              </x-common.title>
              <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
            </header>
          @endif

          @if (isset($data['description']))
            <div class="space-y-4">
              <div class="space-y-4 text-[17px] font-light text-gray-900">
                {!! $data['description'] !!}
              </div>

              @if (isset($data['important_message']))
                <p class="text-primary-400 dark:text-primary-400 text-[17px] font-extrabold">
                  {{ $data['important_message'] }}</p>
              @endif
            </div>
          @endif

          @if (!empty($services))
            <x-common.accordion>
              @foreach ($services as $service)
                @if ($loop->first)
                  <x-common.accordion.item
                    :content="$service['description']"
                    :icon="$service['image']"
                    :open="true"
                    :subtitle="$service['disclaimer'] ?? 'Subtítulo Falso'"
                    :title="$service['title']"
                  />
                @else
                  <x-common.accordion.item
                    :content="$service['description']"
                    :icon="$service['icon']"
                    :subtitle="$service['disclaimer'] ?? 'Subtítulo Falso'"
                    :title="$service['title']"
                  />
                @endif
              @endforeach
            </x-common.accordion>
          @endif

          @if (isset($data['disclaimer']))
            <small class="text-[17px] font-light text-gray-900 dark:text-gray-900">{{ $data['disclaimer'] }}</small>
          @endif

        </div>
      </div>
    </div>
  </section>
@endif
