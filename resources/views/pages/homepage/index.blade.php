<x-layouts.public>
  <main>

    {{-- #Hero --}}
    <article class="relative flex min-h-[700px] items-center">
      <div class="absolute inset-0 bg-[url('https://picsum.photos/1920/1080')] bg-cover bg-center"></div>
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
              class="mt-20 h-[450px] w-[300px] rounded-lg shadow-xl"
              src="https://picsum.photos/300/450"
            >
            <img
              alt="Nuestra Historia"
              class="h-[450px] w-[300px] rounded-lg shadow-xl"
              src="https://picsum.photos/300/450"
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
              class="h-[450px] w-[300px] rounded-lg shadow-xl"
              src="https://picsum.photos/300/450"
            >
            <img
              alt="Nuestra Historia"
              class="mt-20 h-[450px] w-[300px] rounded-lg shadow-xl"
              src="https://picsum.photos/300/450"
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
            <div class="relative h-[450px] w-auto overflow-hidden rounded-none bg-white shadow-lg">
              <div class="absolute inset-0 bg-[url('https://picsum.photos/450/450')] bg-cover bg-center"></div>
              <div class="absolute inset-0 bg-black/50"></div>
              <div class="relative z-10 p-6">
                <h3 class="mb-2 text-wrap text-3xl font-bold text-white">
                  {{ $category['name'] }}
                </h3>
              </div>
            </div>
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

    <article class="bg-gray-50 py-20">
      <div class="container">
        <h2 class="mb-12 text-center text-4xl font-bold">Nuestros Servicios</h2>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
          {{-- @foreach ($services as $service) --}}
          <div class="rounded-lg bg-white p-6 shadow-lg">
            <div class="bg-primary/10 mb-4 flex h-16 w-16 items-center justify-center rounded-full">
              {{-- <x-icon :name="$service['icon']" class="w-8 h-8 text-primary"/> --}}
            </div>
            <h3 class="mb-3 text-xl font-bold">title</h3>
            <p class="text-gray-600">description</p>
          </div>
          {{-- @endforeach --}}
        </div>
      </div>
    </article>

    <article class="container">
      <div class="">
        <h2 class="mb-12 text-center text-4xl font-bold">Certificaciones</h2>
        <div class="flex flex-wrap justify-center gap-8">
          {{-- @foreach ($certifications as $cert) --}}
          <div class="text-center">
            {{-- <img
                alt="{{ $cert['name'] }}"
                class="mx-auto mb-4 h-32 w-32 object-contain grayscale transition-all hover:grayscale-0"
                src="{{ $cert['image'] }}"
              > --}}
            <h3 class="font-bold">Title</h3>
            <p class="text-sm text-gray-600">Description</p>
          </div>
          {{-- @endforeach --}}
        </div>
      </div>
    </article>

    {{-- Countries --}}
  </main>
</x-layouts.public>
