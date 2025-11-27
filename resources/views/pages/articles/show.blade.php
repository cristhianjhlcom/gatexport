<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags
      :canonical="$article->showUrl"
      :description="$article->localizedSeoDescription"
      :image="$article->seoThumbnailUrl"
      :title="$article->localizedSeoTitle"
    />
  </x-slot>

  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="1"
          size="title"
          weight="font-extrabold"
        >
          {{ $article->localizedTitle }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-4xl" />
      </header>

      <div class="md:border-primary-400 flex flex-col items-start gap-4 md:flex-row md:border-l-4">
        <img
          alt="{{ $article->localizedTitle }}"
          class="ml-2 aspect-square w-full object-contain md:size-40"
          src="{{ $article->thumbnailUrl }}"
        >
        <div class="space-y-4">
          <p class="text-md font-medium leading-relaxed text-zinc-600">
            {{ $article->localizedSummary }}
          </p>
          <small class="flex items-center gap-4">
            <flux:icon.calendar size="4" />
            <span>{{ $article->dateForHumans }}</span>
          </small>
        </div>
      </div>

      <section class="prose prose-sm md:prose-md md:text-md text-md space-y-2 leading-relaxed">
        {!! $article->localizedContent !!}
      </section>
    </div>
  </div>
</x-layouts.public>
