<nav class="flex h-16 items-center gap-4 text-gray-900 max-lg:hidden">
  <a class="{{ request()->routeIs('home.index') ? 'border-b-4 border-primary-400 text-primary-400 font-bold' : 'border-b-4 border-transparent' }} flex h-full items-center text-sm uppercase transition"
    href="{{ route('home.index') }}">
    {{ __('layouts.navigation.home') }}
  </a>

  <div
    class="{{ request()->routeIs('products.index') ? 'border-b-4 border-primary-400 ' : 'border-b-4 border-transparent ' }} box-border inline-flex h-full items-center gap-2 px-3 text-sm uppercase transition"
    x-data="{ open: false, active: 0 }">
    <button :aria-expanded="open" @click="open = !open" @mouseenter="open = true" @mouseleave="open = false" aria-haspopup="true"
      class="{{ request()->routeIs('products.index') ? 'text-primary-400 font-bold' : '' }} inline-flex h-full items-center gap-2 uppercase transition"
      type="button">
      Productos
      <flux:icon.chevron-down size="4" />
    </button>

    {{-- OPENAI --}}
    <div @mouseenter="open = true" @mouseleave="open = false"
      class="bg-primary-500 absolute top-16 z-10 flex min-h-[450px] w-full max-w-[900px] rounded-none text-white shadow-md" x-cloak x-show="open"
      x-transition.opacity>
      {{-- Sidebar izquierda --}}
      <aside class="bg-primary-500 w-64 overflow-hidden text-white">
        <ul class="flex flex-col">
          @foreach ($items as $index => $item)
            <li class="border-b border-white/10 capitalize">
              <button @click="active === {{ $index }} ? active = null : active = {{ $index }}"
                @mouseenter="active = {{ $index }}"
                class="flex h-[50px] w-full items-center justify-between px-4 py-3 text-left transition hover:bg-white/10">
                <div class="flex items-center gap-3">
                  @if (isset($item['secondary_icon']))
                    <img alt="{{ $item['name'] }}" class="h-8 w-8" src="{{ $item['secondary_icon'] }}">
                  @endif

                  <span class="text-sm font-extrabold">{{ $item['name'] }}</span>
                </div>

                <flux:icon.chevron-right size="4" />
              </button>
            </li>
          @endforeach
          <li class="border-b border-white/10">
            <a class="flex h-[50px] w-full items-center justify-between px-4 py-3 text-left capitalize transition hover:bg-white/10"
              href="{{ route('products.index') }}">
              <div class="flex items-center gap-3">
                <flux:icon.plus size="8" />

                <span class="text-sm font-extrabold">Todos</span>
              </div>

              <flux:icon.chevron-right size="4" />
            </a>
          </li>
        </ul>
      </aside>

      {{-- Panel derecho --}}
      <section class="relative flex-1 bg-white">
        @foreach ($items as $index => $item)
          <div class="absolute inset-0 grid grid-cols-5 grid-rows-2 gap-2 p-2" x-cloak x-show="active === {{ $index }}" x-transition.opacity>

            {{-- Categoría seleccionada imagen principal --}}
            <a class="relative col-span-3 row-span-1 w-full overflow-hidden rounded-sm bg-transparent capitalize"
              href="{{ route('categories.show', $item['slug']) }}" title="{{ $item['name'] }}">
              <div class="flex h-full items-center justify-center gap-6 p-4 text-left">
                @if (isset($item['primary_icon']))
                  <img alt="{{ $item['name'] }}" class="h-40 w-40 object-contain opacity-35" src="{{ $item['primary_icon'] }}" />
                @endif

                <h6 class="text-primary-500 -ml-10 text-left text-5xl font-extrabold leading-none">
                  @foreach (explode(' ', $item['name']) as $word)
                    <span class="{{ $loop->first ? '-ml-10' : 'ml-0' }} block">{{ $word }}</span>
                  @endforeach
                </h6>
              </div>
            </a>

            <!-- Sub categorías -->
            @foreach ($item['subcategories'] as $index => $subcategory)
              <a class="relative h-full overflow-hidden p-4 text-right capitalize"
                href="{{ route('subcategories.index', [$item['slug'], $subcategory['slug']]) }}"
                style="background-color: {{ $subcategory['background_color'] }}" title="{{ $subcategory['name'] }}">
                <div class="flex h-full flex-col items-baseline justify-between gap-4">
                  @if (isset($subcategory['secondary_icon']))
                    <img alt="{{ $subcategory['name'] }}" class="h-full max-h-[135px] w-full object-contain"
                      src="{{ $subcategory['secondary_icon'] }}" />
                  @endif

                  <h6 class="text-sm font-extrabold italic">
                    {{ $subcategory['name'] }}
                  </h6>
                </div>
              </a>
            @endforeach

          </div>
        @endforeach
      </section>
    </div>
  </div>

  <a class="{{ request()->routeIs('about-us.index') ? 'border-b-4 border-primary-400 text-primary-400 font-bold' : 'border-b-4 border-transparent' }} flex h-full items-center text-sm uppercase transition"
    href="{{ route('about-us.index') }}">
    {{ __('layouts.navigation.about_us') }}
  </a>

  <a class="{{ request()->routeIs('services.index') ? 'border-b-4 border-primary-400 text-primary-400 font-bold' : 'border-b-4 border-transparent' }} flex h-full items-center text-sm uppercase transition"
    href="{{ route('services.index') }}">
    {{ __('layouts.navigation.services') }}
  </a>
</nav>
