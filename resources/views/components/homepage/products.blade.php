@props(['categories'])

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
