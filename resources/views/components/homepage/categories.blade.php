@props([
    'highlighted_categories' => [],
])

<section class="bg-primary-50 py-10 md:py-14 dark:bg-gray-800">

  <div class="container space-y-16 overflow-hidden">

    <header class="flex flex-col space-y-4">
      <x-common.title
        class="text-center"
        level="2"
        size="title"
        weight="font-extrabold"
      >
        {{ __('pages.home.products.title') }}
      </x-common.title>
      <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
    </header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">

      @foreach ($highlighted_categories['translations'] as $category)
        <div class="relative col-span-2 flex h-[30rem] items-end overflow-hidden bg-gray-300 p-6 lg:col-span-1">
          {{-- Aquí va tu imagen de fondo --}}
          <img
            alt="{{ $category['title'] }}"
            class="absolute inset-0 h-full w-full object-cover opacity-80 mix-blend-multiply"
            src="{{ Storage::disk('public')->url($category['image']) }}"
          >
          {{--
          <div class="z-10 text-white">
            <h2 class="text-4xl font-bold tracking-tight md:text-5xl">{{ $category['name'] }}</h2>
            <p class="mt-2 text-xl font-semibold md:text-2xl">{{ $category['short_description'] }}</p>
          </div>
          --}}
        </div>
      @endforeach

    </div>

  </div>
</section>
