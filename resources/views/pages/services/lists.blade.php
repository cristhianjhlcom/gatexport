<section class="w-full py-10">
  <div class="container">
    <div class="space-y-10">
      <header class="align-items flex flex-col justify-center space-y-2 text-center">
        <h2 class="text-primary-500 dark:text-primary-500 text-2xl font-extrabold leading-tight md:text-3xl">
          {{ __('pages.services.title') }}
        </h2>
        <x-common.separator-line
          class="mx-auto w-full max-w-[400px]"
          color="border-primary-500"
          pointColor="bg-primary-500"
        />
      </header>

      <div class="grid grid-cols-1 gap-10 md:grid-cols-6">
        @foreach ($services as $service)
          @php
            $class = $loop->first ? 'md:col-span-4 md:col-start-2' : 'md:col-span-3';
          @endphp
          <div class="{{ $class }} space-y-4">
            <header class="rounded-4xl bg-primary-100 flex items-center justify-center gap-4 px-4 py-2 md:px-2 md:py-2">
              @if (!empty($service['image']))
                <img
                  alt="{{ $service['title'] }}"
                  class="h-10 w-10 object-contain"
                  src="{{ Storage::disk('public')->url($service['image']) }}"
                >
              @endif
              <h3 class="text-primary-400 dark:text-primary-400 text-sm font-extrabold leading-relaxed md:text-lg">
                {{ $service['title'] }}
              </h3>
            </header>

            <div
              class="border-primary-300 border-3 flex min-h-56 flex-col items-center justify-center gap-4 rounded-3xl bg-white px-10 py-4 text-center"
            >
              <p class="leading-relaxed text-gray-900">
                {{ $service['description'] }}
              </p>

              <div class="bg-primary-400 block h-0.5 w-full"></div>

              @if (!empty($service['disclaimer']))
                <p class="text-primary-400 text-sm font-semibold">
                  {{ $service['disclaimer'] }}
                </p>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
