@props(['advantages'])

<article class="py-10 md:py-16 lg:py-20">
  <div class="container">
    <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">Ventajas Competitivas</h2>
    <div class="grid gap-6 sm:grid-cols-2 md:gap-8 lg:grid-cols-3">
      @foreach ($advantages as $advantage)
        <div class="flex flex-col items-center space-y-4 rounded-lg p-6 text-center transition-colors hover:bg-gray-50">
          <flux:icon :name="$advantage['icon']" class="text-primary h-8 w-8" />
          <h3 class="text-lg font-bold md:text-xl">
            {{ $advantage['title'] }}
          </h3>
          <p class="text-sm text-gray-600 md:text-base">
            {{ $advantage['description'] }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</article>
