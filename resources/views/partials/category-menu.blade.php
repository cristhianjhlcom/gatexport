  @php
    $isActive = request()->routeIs('products.*');
    $isHomePage = request()->routeIs('home.index');
  @endphp

  <div @class([
      'border-b-4 border-primary-400' => $isActive,
      'border-b-4 border-transparent' => !$isActive,
      'text-white font-semibold' => $theme === 'dark',
      'text-zinc-900 font-semibold' => $theme === 'light',
      'box-border inline-flex h-full items-center gap-2 font-semibold p-0 text-md uppercase transition',
  ]) x-data="{ open: false, active: 0 }">
    <button
      :aria-expanded="open"
      @click="open = !open"
      @mouseenter="open = true"
      @mouseleave="open = false"
      @class([
          'text-primary-400 font-bold' => $isActive,
          'inline-flex h-full items-center gap-2 uppercase transition',
      ])
      aria-haspopup="true"
      type="button"
    >
      {{ __('layouts.navigation.products') }}
      <flux:icon.chevron-down size="4" />
    </button>

    <div
      @mouseenter="open = true"
      @mouseleave="open = false"
      class="bg-primary-500 absolute top-16 z-10 flex min-h-[550px] w-full max-w-[950px] rounded-none text-white shadow-md"
      x-cloak
      x-show="open"
      x-transition.opacity
    >
      {{-- Menú de categorías --}}
      <aside class="bg-primary-500 w-64 overflow-hidden text-white">
        <ul class="flex flex-col">
          @foreach ($items as $index => $item)
            <li class="border-b border-white/10 capitalize">
              <a
                @mouseenter="active = {{ $index }}"
                class="flex h-[61.20px] w-full items-center justify-between px-4 py-3 text-left transition hover:bg-white/10"
                href="{{ $item['url'] }}"
              >
                <div class="flex items-center gap-3">
                  @if (isset($item['secondary_icon']))
                    <img
                      alt="{{ $item['name'] }}"
                      class="h-8 w-8"
                      src="{{ $item['secondary_icon'] }}"
                    >
                  @endif

                  <span class="text-sm font-extrabold">{{ $item['name'] }}</span>
                </div>

                <flux:icon.chevron-right size="4" />
              </a>
            </li>
          @endforeach
          <li class="border-b border-white/10">
            <a class="flex h-[50px] w-full items-center justify-between px-4 py-3 text-left capitalize transition hover:bg-white/10"
              href="{{ route('products.index') }}"
            >
              <div class="flex items-center gap-3">
                <flux:icon.plus size="8" />

                <span class="text-sm font-extrabold">{{ __('layouts.navigation.all') }}</span>
              </div>

              <flux:icon.chevron-right size="4" />
            </a>
          </li>
        </ul>
      </aside>

      {{-- Menú de sub-categorías --}}
      <section class="relative flex-1 bg-white">
        @foreach ($items as $index => $item)
          <div
            @class([
                'grid-rows-1 grid-cols-6' => count($item['subcategories']) <= 2,
                'grid-rows-2 grid-cols-5' => count($item['subcategories']) >= 3,
                'absolute inset-0 grid gap-2 p-2',
            ])
            x-cloak
            x-show="active === {{ $index }}"
            x-transition.opacity
          >

            {{-- Categoría seleccionada imagen principal --}}
            <a
              @class([
                  'col-span-6' => count($item['subcategories']) <= 2,
                  'col-span-3  row-span-1' => count($item['subcategories']) >= 3,
                  'relative w-full overflow-hidden rounded-sm bg-transparent capitalize',
              ])
              href="{{ $item['url'] }}"
              title="{{ $item['name'] }}"
            >
              <div class="flex h-full items-center justify-center gap-6 p-4 text-left">
                @if (isset($item['primary_icon']))
                  <img
                    alt="{{ $item['name'] }}"
                    class="size-40 object-contain opacity-35"
                    src="{{ $item['primary_icon'] }}"
                  />
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
              <a
                @class([
                    'col-span-3' => count($item['subcategories']) <= 2,
                    'relative h-full overflow-hidden px-4 pt-4 pb-2 text-right capitalize',
                ])
                href="{{ route('subcategories.index', [$item['slug'], $subcategory['slug']]) }}"
                style="background-color: {{ $subcategory['background_color'] }}"
                title="{{ $subcategory['name'] }}"
              >
                <div class="flex h-full flex-col items-baseline justify-between gap-4 text-right">
                  @if (isset($subcategory['secondary_icon']))
                    <img
                      alt="{{ $subcategory['name'] }}"
                      class="h-full max-h-[125px] w-full object-contain"
                      src="{{ $subcategory['secondary_icon'] }}"
                    />
                  @endif

                  <div class="flex justify-end">
                    <h6 class="mr-auto text-right text-xs font-extrabold italic">
                      {{ $subcategory['name'] }}
                    </h6>
                  </div>
                </div>
              </a>
            @endforeach

          </div>
        @endforeach
      </section>
    </div>
  </div>
