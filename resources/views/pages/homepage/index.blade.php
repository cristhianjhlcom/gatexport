<x-layouts.public>
  <main>

    {{-- #Hero --}}
    <article class="relative flex min-h-[700px] items-center">
      <div class="absolute inset-0 bg-[url('https://placehold.net/8-800x600.png')] bg-cover bg-center"></div>
      <div class="absolute inset-0 bg-black/50"></div>
      <div class="container relative z-10">
        <div class="justify-space-between flex items-center">
          <div class="space-y-6 text-white md:w-3/4">
            <h1 class="text-8xl font-bold">Lorem ipsum dolor sit amet</h1>
            <p class="text-md font-normal leading-relaxed">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet
              molestie condimentum lacus. Praesent mollis vitae mi a congue. Vestibulum a leo vel quam sodales iaculis
              eu eu felis. Mauris feugiat a mauris quis lobortis. Integer porta efficitur sagittis.
            </p>
            <flux:button type="button" variant="primary">
              Contáctanos
            </flux:button>
          </div>
        </div>
      </div>
    </article>
    {{-- #END Hero --}}

    {{-- #History --}}
    <article class="bg-gray-50 py-20">
      <div class="container space-y-12">

        <div class="flex flex-col items-center gap-12 md:flex-row">
          <div class="flex items-center justify-center gap-x-4 md:w-1/2">
            <img
              alt="Nuestra Historia"
              class="mt-20 aspect-auto h-[400px] w-[600px] rounded-lg"
              src="https://placehold.net/400x600.png"
            >
            <img
              alt="Nuestra Historia"
              class="aspect-auto h-[400px] w-[600px] rounded-lg"
              src="https://placehold.net/400x600.png"
            >
          </div>
          <div class="space-y-6 md:w-1/2">
            <h2 class="text-4xl font-bold">Nuestra Historia</h2>
            <p class="text-lg text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet
              molestie condimentum lacus. Praesent mollis vitae mi a congue. Vestibulum a leo vel quam sodales iaculis
              eu eu felis. Mauris feugiat a mauris quis lobortis. Integer porta efficitur sagittis. Curabitur tincidunt
              elit a arcu tempus mollis. Duis rhoncus odio tortor, nec auctor elit hendrerit eu.
            </p>

            <span class="text-2xl font-thin italic text-gray-500">
              Lorem ipsum dolor sit amet.
            </span>
          </div>
        </div>

        <div class="flex flex-col items-center gap-12 md:flex-row">
          <div class="space-y-6 md:w-1/2">
            <h2 class="text-4xl font-bold">Lorem Ipsum</h2>
            <p class="text-lg text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lorem et metus euismod laoreet
              molestie condimentum lacus. Praesent mollis vitae mi a congue. Vestibulum a leo vel quam sodales iaculis
              eu eu felis. Mauris feugiat a mauris quis lobortis. Integer porta efficitur sagittis. Curabitur tincidunt
              elit a arcu tempus mollis. Duis rhoncus odio tortor, nec auctor elit hendrerit eu.
            </p>
            <div>
              <flux:button type="button" variant="primary">
                Contáctanos
              </flux:button>
              <flux:button type="button" variant="ghost">
                Productos
              </flux:button>
            </div>
          </div>
          <div class="flex items-center justify-center gap-x-4 md:w-1/2">
            <img
              alt="Nuestra Historia"
              class="aspect-video h-[400px] w-[600px] rounded-lg"
              src="https://placehold.net/5.png"
            >
          </div>
        </div>

      </div>
    </article>
    {{-- #END History --}}

    {{-- #Advantages --}}
    <article class="py-20">
      <div class="container">
        <h2 class="mb-12 text-center text-4xl font-bold">Ventajas Competitivas</h2>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($advantages as $advantage)
            <div class="flex flex-col items-center space-y-5 text-center">
              <flux:icon :name="$advantage['icon']" class="text-primary h-8 w-8 text-center" />
              <h3 class="mb-3 text-xl font-bold">
                {{ $advantage['title'] }}
              </h3>
              <p class="text-gray-600">
                {{ $advantage['description'] }}
              </p>
            </div>
          @endforeach
        </div>
      </div>
    </article>
    {{-- #END Advantages --}}

    {{-- #Products --}}
    <article class="bg-gray-50 py-20">
      <div class="container">
        <h2 class="mb-12 text-center text-4xl font-bold">Nuestros Productos</h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          @foreach ($categories as $idx => $category)
            <a class="relative w-auto overflow-hidden rounded-sm bg-white"
              href="{{ route('categories.show', $category->slug) }}"
            >
              <div class="absolute inset-0 overflow-hidden bg-gray-800/70"></div>
              <img
                alt="{{ $category->name }}"
                class="aspect-auto w-full rounded-lg"
                src="{{ $category->imagePath }}"
              />
              <h3 class="absolute left-4 top-4 text-wrap text-xl font-bold text-white">
                {{ $category->name }}
              </h3>
            </a>
          @endforeach
        </div>
      </div>
    </article>
    {{-- #END Products --}}

    {{-- #Process
    <article class="container">
      <div class="">
        <h2 class="mb-12 text-center text-4xl font-bold">Nuestro Proceso</h2>
        <div class="relative">
          <!-- Línea conectora -->
          <div class="bg-primary absolute left-0 top-1/2 hidden h-1 w-full -translate-y-1/2 transform md:block"></div>
          <div class="grid gap-8 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($steps as $step)
            <div class="relative flex flex-col items-center">
              <div
                class="bg-primary relative z-10 mb-4 flex h-16 w-16 items-center justify-center rounded-full text-2xl text-white"
              >
              </div>
              <h3 class="mb-2 text-center text-xl font-bold">Title</h3>
              <p class="text-center text-sm text-gray-600">Description</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </article>
    #END Process --}}

    {{-- #Services
    <article class="bg-gray-50 py-20">
      <div class="container">
        <h2 class="mb-12 text-center text-4xl font-bold">Nuestros Servicios</h2>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
          @foreach ($services as $service)
          <div class="rounded-lg bg-white p-6 shadow-lg">
            <div class="bg-primary/10 mb-4 flex h-16 w-16 items-center justify-center rounded-full">
            </div>
            <h3 class="mb-3 text-xl font-bold">title</h3>
            <p class="text-gray-600">description</p>
          </div>
          @endforeach
        </div>
      </div>
    </article>
    #END Services --}}
  </main>
</x-layouts.public>
