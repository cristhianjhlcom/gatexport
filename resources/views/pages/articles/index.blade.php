<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags :canonical="route('articles.index')" :title="__('pages.articles.title')" />
  </x-slot>

  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="1"
          size="super-title"
          weight="font-extrabold"
        >
          {{ __('pages.articles.title') }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-sm" />
      </header>

      <section class="space-y-4">
        @foreach ($articles as $article)
          <div class="flex flex-col items-center gap-8 rounded-md bg-white p-8 md:flex-row">
            <img
              alt="{{ $article['title'] }}"
              class="aspect-auto w-full rounded-sm object-cover md:w-1/2"
              src="{{ $article['thumbnail'] }}"
            >
            <div class="flex flex-1 flex-col">
              <!-- Contenido superior: título y descripción -->
              <div class="space-y-4">
                <h2 class="text-md font-extrabold capitalize leading-relaxed text-zinc-900 md:text-3xl">
                  {{ $article['title'] }}
                </h2>
                <p class="md:text-md text-sm font-medium leading-relaxed text-zinc-500">
                  {!! $article['summary'] !!}
                </p>
              </div>

              <div class="mt-4 space-y-4">
                <hr class="bg-primary-100 block h-0.5 w-full border-none" />
                <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between">
                  <span class="flex items-center gap-4 text-sm text-zinc-500">
                    <flux:icon.calendar size="4" />
                    <span>{{ $article['published_at'] }}</span>
                  </span>

                  <a
                    class="text-primary-400 flex items-center gap-4 font-extrabold"
                    href="{{ $article['slug'] }}"
                    title="{{ $article['title'] }}"
                  >
                    <span>{{ __('pages.articles.read_more') }}</span>
                    <flux:icon.arrow-long-right size="4" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        {{-- <div>
          {{ $articles->links() }}
        </div> --}}
      </section>
    </div>
  </div>
</x-layouts.public>
