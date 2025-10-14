@props([
    'highlighted_categories' => [],
])

<section class="bg-primary-50 dark:bg-primary-50 py-10 md:py-14">

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

      @if (isset($highlighted_categories['translations']))
        @foreach ($highlighted_categories['translations'] as $index => $category)
          @if ($index === 0)
            {{-- 1. PALO SANTO: col-span-2 en mobile, col-span-1 en desktop. Altura completa. --}}
            <a class="relative col-span-2 flex h-[300px] items-end overflow-hidden p-6 md:h-[34rem] lg:col-span-1"
              href="{{ $category['url'] }}"
            >
              <img
                alt="{{ $category['title'] }}"
                class="absolute inset-0 h-full w-full transition-opacity hover:opacity-90 md:object-fill"
                src="{{ Storage::disk('public')->url($category['image']) }}"
              >
            </a>
          @elseif ($index === 1)
            {{-- 2. INCIENSOS: col-span-2 en mobile, col-span-1 en desktop. Altura completa. --}}
            <a class="relative col-span-2 flex h-[300px] items-end overflow-hidden p-6 md:h-[34rem] lg:col-span-1"
              href="{{ $category['url'] }}"
            >
              <img
                alt="{{ $category['title'] }}"
                class="absolute inset-0 h-full w-full transition-opacity hover:opacity-90 md:object-fill"
                src="{{ Storage::disk('public')->url($category['image']) }}"
              >
            </a>
          @elseif ($index === 2 || $index === 3)
            @if ($index === 2)
              {{-- Contenedor para SMUDGE POP y SMUDGE STICK --}}
              <div class="col-span-2 flex flex-col gap-4 lg:col-span-1">
            @endif

            {{-- Bloques pequeños --}}
            <a class="relative col-span-2 flex h-[300px] items-end overflow-hidden p-4 md:h-[16.5rem] lg:col-span-1"
              href="{{ $category['url'] }}"
            >
              <img
                alt="{{ $category['title'] }}"
                class="absolute inset-0 h-full w-full object-contain transition-opacity hover:opacity-90 md:object-fill"
                src="{{ Storage::disk('public')->url($category['image']) }}"
              >
            </a>

            @if ($index === 3)
    </div>
    @endif
    @endif
    @endforeach
    @endif

  </div>

  </div>
</section>
