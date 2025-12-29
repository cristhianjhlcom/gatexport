<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags
      :canonical="$article['canonical_url']"
      :description="$article['meta_description']"
      :image="$article['thumbnail']"
      :title="$article['title']"
    />
  </x-slot>

  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-left"
          level="1"
          size="super-title"
          weight="font-extrabold"
        >
          {{ $article['title'] }}
        </x-common.title>
        <x-common.separator-line class="w-full max-w-4xl" />
      </header>

      <div class="flex flex-col items-start gap-4 md:flex-row">
        <div class="space-y-4">
          <div class="border-primary-400 bg-primary-500/10 space-y-4 rounded-sm border-l-8 px-4 py-8">
            <p class="text-md ml-4 font-medium leading-relaxed text-zinc-600">
              {!! $article['summary'] !!}
            </p>

            <small class="ml-4 flex items-center gap-4">
              <flux:icon.calendar size="4" />
              <span>{{ $article['published_at'] }}</span>
            </small>
          </div>

          <img
            alt="{{ $article['title'] }}"
            class="aspect-auto w-full rounded-sm object-cover"
            src="{{ $article['thumbnail'] }}"
          >
        </div>
      </div>

      <section class="special-content space-y-6">
        {!! $article['content'] !!}
      </section>
    </div>
  </div>
</x-layouts.public>
