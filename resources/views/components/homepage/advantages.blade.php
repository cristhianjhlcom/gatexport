@props([
    'competitive_advantages' => [],
])

<section class="py-10 md:py-16 lg:py-20">
  <div class="container">
    <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">Ventajas Competitivas</h2>
    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($competitive_advantages as $advantage)
        <article
          class="border-primary-100 hover:bg-primary-100 bg-primary-50 flex flex-col space-y-4 rounded-sm border p-6 transition-colors"
        >
          <header class="flex items-center justify-start gap-4">
            <img
              alt="{{ $advantage['title'] }}"
              class="h-16 w-16 rounded-full object-cover"
              src="{{ Storage::disk('public')->url($advantage['image']) }}"
            >
            <h3 class="text-lg font-bold md:text-xl">
              {{ $advantage['title'] }}
            </h3>
          </header>
          <div class="text-sm text-gray-600 md:text-base">
            {!! $advantage['description'] !!}
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
