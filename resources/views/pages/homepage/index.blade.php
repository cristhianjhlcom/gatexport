<x-layouts.public>
  <main>
    {{-- #Hero --}}
    <article class="relative flex min-h-[500px] items-center md:min-h-[600px] lg:min-h-[700px]">
      <div class="absolute inset-0 bg-[url('https://placehold.net/8-800x600.png')] bg-cover bg-center"></div>
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="container relative z-10">
        <div class="flex items-center">
          <div class="w-full space-y-4 text-white md:w-4/5 md:space-y-6 lg:w-3/4">
            <h1 class="text-4xl font-bold leading-tight md:text-6xl lg:text-8xl">Lorem ipsum dolor sit amet</h1>
            <p class="text-sm font-normal leading-relaxed md:text-base lg:text-lg">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet
              molestie condimentum lacus.
            </p>
            <flux:button
              class="w-full md:w-auto"
              type="button"
              variant="primary"
            >
              Contáctanos
            </flux:button>
          </div>
        </div>
      </div>
    </article>

    {{-- #History --}}
    <article class="bg-gray-50 py-10 md:py-16 lg:py-20">
      <div class="container space-y-8 md:space-y-12">
        <div class="flex flex-col-reverse items-center gap-8 md:flex-row md:gap-12">
          <div class="flex w-full flex-col items-center justify-center gap-4 md:w-1/2 md:flex-row">
            <img
              alt="Nuestra Historia"
              class="h-[300px] w-full rounded-lg object-cover md:h-[400px] md:w-1/2"
              src="https://placehold.net/400x600.png"
            >
            <img
              alt="Nuestra Historia"
              class="mt-4 h-[300px] w-full rounded-lg object-cover md:mt-20 md:h-[400px] md:w-1/2"
              src="https://placehold.net/400x600.png"
            >
          </div>
          <div class="w-full space-y-4 md:w-1/2 md:space-y-6">
            <h2 class="text-3xl font-bold md:text-4xl">Nuestra Historia</h2>
            <p class="text-base text-gray-600 md:text-lg">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet
              molestie condimentum lacus.
            </p>
            <span class="block text-xl font-thin italic text-gray-500 md:text-2xl">
              Lorem ipsum dolor sit amet.
            </span>
          </div>
        </div>

        <div class="flex flex-col items-center gap-8 md:flex-row md:gap-12">
          <div class="w-full space-y-4 md:w-1/2 md:space-y-6">
            <h2 class="text-3xl font-bold md:text-4xl">Lorem Ipsum</h2>
            <p class="text-base text-gray-600 md:text-lg">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet.
            </p>
            <div class="flex flex-col gap-4 sm:flex-row">
              <flux:button
                class="w-full sm:w-auto"
                type="button"
                variant="primary"
              >
                Contáctanos
              </flux:button>
              <flux:button
                class="w-full sm:w-auto"
                type="button"
                variant="ghost"
              >
                Productos
              </flux:button>
            </div>
          </div>
          <div class="w-full md:w-1/2">
            <img
              alt="Nuestra Historia"
              class="h-[300px] w-full rounded-lg object-cover md:h-[400px]"
              src="https://placehold.net/5.png"
            >
          </div>
        </div>
      </div>
    </article>

    {{-- #Advantages --}}
    <article class="py-10 md:py-16 lg:py-20">
      <div class="container">
        <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">Ventajas Competitivas</h2>
        <div class="grid gap-6 sm:grid-cols-2 md:gap-8 lg:grid-cols-3">
          @foreach ($advantages as $advantage)
            <div
              class="flex flex-col items-center space-y-4 rounded-lg p-6 text-center transition-colors hover:bg-gray-50"
            >
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

    {{-- #Products --}}
    <article class="bg-gray-50 py-10 md:py-16 lg:py-20">
      <div class="container">
        <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">Nuestros Productos</h2>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          @foreach ($categories as $idx => $category)
            <a class="group relative overflow-hidden rounded-lg transition-transform hover:scale-105"
              href="{{ route('categories.show', $category->slug) }}"
            >
              <div class="absolute inset-0 bg-gray-800/70 transition-opacity group-hover:bg-gray-800/50"></div>
              <img
                alt="{{ $category->name }}"
                class="aspect-square w-full object-cover"
                src="{{ $category->imagePath }}"
              />
              <h3 class="absolute left-4 top-4 text-lg font-bold text-white md:text-xl">
                {{ $category->name }}
              </h3>
            </a>
          @endforeach
        </div>
      </div>
    </article>

    <x-homepage.maps />
  </main>
</x-layouts.public>
