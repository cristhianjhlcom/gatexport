<nav class="flex items-center gap-4 max-lg:hidden">
  <a href="{{ route('home.index') }}">
    {{ __('layouts.navigation.home') }}
  </a>

  <div x-data="{ open: false, active: null }">
    <button
      :aria-expanded="open"
      @click="open = !open"
      @mouseenter="open = true"
      @mouseleave="open = false"
      aria-haspopup="true"
      class="text-primary-900 inline-flex items-center gap-2 rounded-md px-3 py-2"
      type="button"
    >
      Productos
      <flux:icon.chevron-down size="4" />
    </button>

    {{-- OPENAI --}}
    <div
      @mouseenter="open = true"
      @mouseleave="open = false"
      class="bg-primary-500 absolute top-16 z-10 flex min-h-[400px] w-full max-w-[900px] rounded-none text-white shadow-md"
      x-show="open"
      x-transition.opacity
    >
      {{-- Sidebar izquierda --}}
      <aside class="bg-primary-500 w-64 overflow-hidden rounded-l-lg text-white">
        <ul class="flex flex-col">
          @foreach ($items as $index => $item)
            <li class="border-b border-white/10">
              <button
                @click="active === {{ $index }} ? active = null : active = {{ $index }}"
                @mouseenter="active = {{ $index }}"
                class="flex h-[50px] w-full items-center justify-between px-4 py-3 text-left transition hover:bg-white/10"
              >
                <div class="flex items-center gap-3">
                  <img
                    alt="{{ $item['name'] }}"
                    class="h-8 w-8"
                    src="{{ $item['secondary_icon'] }}"
                  >

                  <span class="font-medium">{{ $item['name'] }}</span>
                </div>

                <flux:icon.chevron-right size="4" />
              </button>
            </li>
          @endforeach
        </ul>
      </aside>

      {{-- Panel derecho --}}
      <section class="relative flex-1 bg-white">
        @foreach ($items as $index => $item)
          <div
            class="{{ count($item['subcategories']) > 3 ? 'grid-rows-2' : 'grid-rows-1' }} absolute inset-0 grid grid-cols-5 gap-2 p-2"
            x-show="active === {{ $index }}"
            x-transition.opacity
          >
            <a
              class="relative col-span-3 row-span-1 w-full overflow-hidden rounded-sm bg-transparent"
              href="{{ route('categories.show', $item['slug']) }}"
              title="{{ $item['name'] }}"
            >
              <div
                class="{{ count($item['subcategories']) > 3 ? 'flex-row' : 'flex-col' }} flex h-full items-center justify-center gap-6 p-4 text-left"
              >
                <img
                  alt="{{ $item['name'] }}"
                  class="h-40 w-40 object-contain opacity-35"
                  src="{{ $item['primary_icon'] }}"
                />

                <h6 class="text-primary-500 -ml-10 text-left text-5xl font-extrabold leading-normal">
                  @foreach (explode(' ', $item['name']) as $word)
                    <span class="{{ $loop->first ? '-ml-10' : 'ml-0' }} block">{{ $word }}</span>
                  @endforeach
                </h6>
              </div>
            </a>

            @if (count($item['subcategories']) < 3)
              @foreach ($item['subcategories'] as $index => $subcategory)
                <a
                  class="relative col-span-2 col-start-4 w-1/2 overflow-hidden p-4 text-right"
                  href="{{ route('subcategories.index', [$item['slug'], $subcategory['slug']]) }}"
                  style="background-color: {{ $subcategory['background_color'] }}"
                  title="{{ $subcategory['name'] }}"
                >
                  <div class="flex h-full flex-col items-baseline justify-between gap-4">
                    <img
                      alt="{{ $subcategory['name'] }}"
                      class="h-full w-full object-contain"
                      src="{{ $subcategory['secondary_icon'] }}"
                    />

                    <h6 class="text-sm font-semibold italic">
                      {{ $subcategory['name'] }}
                    </h6>
                  </div>
                </a>
              @endforeach
            @else
              <!-- Sub categorías -->
              @foreach ($item['subcategories'] as $index => $subcategory)
                <a
                  class="{{ $index < 2 ? 'col-start-' . ($index + 4) : '' }} relative h-full overflow-hidden p-4 text-right"
                  href="{{ route('subcategories.index', [$item['slug'], $subcategory['slug']]) }}"
                  style="background-color: {{ $subcategory['background_color'] }}"
                  title="{{ $subcategory['name'] }}"
                >
                  <div class="flex h-full flex-col items-baseline justify-between gap-4">
                    <img
                      alt="{{ $subcategory['name'] }}"
                      class="h-full w-full object-contain"
                      src="{{ $subcategory['secondary_icon'] }}"
                    />

                    <h6 class="text-sm font-semibold italic">
                      {{ $subcategory['name'] }}
                    </h6>
                  </div>
                </a>
              @endforeach
            @endif
          </div>
        @endforeach
      </section>
    </div>
  </div>

  <a href="{{ route('about-us.index') }}">
    {{ __('layouts.navigation.about_us') }}
  </a>

  <a href="{{ route('services.index') }}">
    {{ __('layouts.navigation.services') }}
  </a>
</nav>
