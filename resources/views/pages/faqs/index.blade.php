<x-layouts.public :title="$title ?? 'Preguntas Frecuentes'">
  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="1"
          size="super-title"
          weight="font-extrabold"
        >
          Preguntas Frecuentes
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-[1000px]" />
      </header>

      <div class="mx-auto flex w-full flex-col items-start gap-6">
        @forelse ($faqs as $faq)
          <details
            class="md:rounded-4xl w-full rounded-xl bg-white p-4 md:px-10 md:py-6"
            name="services-accordion"
            x-bind:open="open"
            x-data="{ open: false }"
          >
            <summary
              class="flex w-full cursor-pointer list-none items-center gap-4 text-left focus:outline-none [&::-webkit-details-marker]:hidden"
              name="accordion-header"
              x-on:click.prevent="open = !open"
            >
              <h3 class="text-primary-400 grow text-sm font-extrabold md:text-xl">
                {{ $faq->question[app()->getLocale()] }}
              </h3>

              <flux:icon.chevron-up
                class="text-primary-400"
                size="8"
                x-show="open"
              />

              <flux:icon.chevron-down
                class="text-primary-400"
                size="8"
                x-show="!open"
              />
            </summary>
            <div class="space-y-4 pt-4">
              <div class="bg-primary-400 block h-0.5 w-full"></div>
              <p class="text-md leading-relaxed text-gray-900 dark:text-gray-900">
                {{ $faq->answer[app()->getLocale()] }}
              </p>
            </div>
          </details>
        @empty
          <div>
            <h2>Aún no hay preguntas frecuentes.</h2>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-layouts.public>
