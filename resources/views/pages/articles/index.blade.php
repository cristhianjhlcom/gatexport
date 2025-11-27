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
          <div class="space-y-2 rounded-sm bg-white p-4">
            <h2 class="text-md text-primary-400 font-extrabold capitalize leading-relaxed md:text-2xl">
              {{ $article->localizedTitle }}
            </h2>
            <p class="md:text-md text-sm font-medium leading-relaxed text-zinc-500">{{ $article->localizedSummary }}</p>
            <hr class="bg-primary-100 block h-0.5 w-full border-none" />
            <div class="flex items-center justify-between">
              <small class="flex items-center gap-4">
                <flux:icon.calendar size="4" />
                <span>{{ $article->dateForHumans }}</span>
              </small>

              <a
                class="text-primary-400 flex items-center gap-4"
                href="{{ $article->showUrl }}"
                title="{{ $article->localizedTitle }}"
              >
                <span>{{ __('pages.articles.read_more') }}</span>
                <flux:icon.arrow-long-right size="4" />
              </a>
            </div>
          </div>
        @endforeach
        <div>
          {{ $articles->links() }}
        </div>
      </section>
    </div>
  </div>
</x-layouts.public>
