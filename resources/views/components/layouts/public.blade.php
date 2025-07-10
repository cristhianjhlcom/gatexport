<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? __('Public') }}</title>

  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  <flux:header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900" container>
    <flux:sidebar.toggle
      class="lg:hidden"
      icon="bars-2"
      inset="left"
    />
    <flux:brand
      class="max-lg:hidden dark:hidden"
      href="{{ route('home.index') }}"
      logo="https://fluxui.dev/img/demo/logo.png"
      name="Gate Export"
    />
    <flux:brand
      class="max-lg:hidden! hidden dark:flex"
      href="{{ route('home.index') }}"
      logo="https://fluxui.dev/img/demo/dark-mode-logo.png"
      name="Gate Export"
    />
    <flux:navbar class="-mb-px max-lg:hidden">
      <flux:navbar.item current href="{{ route('home.index') }}">
        {{ __('Home') }}
      </flux:navbar.item>

      <flux:dropdown>
        <flux:navbar.item icon:trailing="chevron-down">
          {{ __('Products') }}
        </flux:navbar.item>
        <flux:navmenu>
          <div class="z-100 flex flex-col space-y-2">
            @foreach ($navigationCategories as $category)
              <flux:dropdown
                align="end"
                hover
                position="right"
              >
                <flux:button
                  class="flex w-full items-center !justify-between rounded-sm"
                  icon:trailing="chevron-right"
                  type="button"
                  variant="ghost"
                >
                  <flux:heading>{{ $category['name'] }}</flux:heading>
                </flux:button>

                <flux:popover class="max-w-[800px] p-0">
                  <div class="grid grid-cols-5 grid-rows-2 gap-2 p-2">
                    <!-- Imagen principal de categoría -->
                    <a class="relative col-span-3 row-span-1 h-[200px] overflow-hidden rounded-sm"
                      href="{{ route('categories.show', $category['slug']) }}"
                    >
                      <img
                        alt="{{ $category['name'] }}"
                        class="h-full w-full object-cover"
                        src="{{ $category['image'] }}"
                      />
                      <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                      <h6 class="absolute bottom-3 left-3 text-lg font-bold text-white">
                        {{ $category['name'] }}
                      </h6>
                    </a>

                    <!-- Subcategorías -->
                    @foreach ($category['subcategories'] as $index => $subcategory)
                      <a
                        class="{{ $index < 2 ? 'col-start-' . ($index + 4) : '' }} relative overflow-hidden rounded-sm"
                        href="{{ route('subcategories.index', [$category['slug'], $subcategory['slug']]) }}"
                        title="{{ $subcategory['name'] }}"
                      >
                        <img
                          alt="{{ $subcategory['name'] }}"
                          class="h-full w-full object-cover"
                          src="{{ $subcategory['image'] }}"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <h6 class="absolute bottom-2 left-2 text-xs font-semibold text-white">
                          {{ $subcategory['name'] }}
                        </h6>
                      </a>
                    @endforeach
                  </div>
                </flux:popover>
              </flux:dropdown>
            @endforeach
          </div>
        </flux:navmenu>
      </flux:dropdown>

    </flux:navbar>
    <flux:spacer />
    <flux:navbar class="me-4">
      <flux:navbar.item
        href="#"
        icon="magnifying-glass"
        label="Search"
      />
    </flux:navbar>
    <flux:dropdown align="start" position="top">
      <flux:profile name="Spanish" />
      <flux:menu>
        <flux:menu.radio.group>
          <flux:menu.radio checked>
            {{ __('Spanish') }}
          </flux:menu.radio>
          <flux:menu.radio>
            {{ __('English') }}
          </flux:menu.radio>
        </flux:menu.radio.group>
      </flux:menu>
    </flux:dropdown>
  </flux:header>
  <flux:sidebar
    class="border border-zinc-200 bg-zinc-50 lg:hidden rtl:border-l rtl:border-r-0 dark:border-zinc-700 dark:bg-zinc-900"
    stashable
    sticky
  >
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand
      class="px-2 dark:hidden"
      href="{{ route('home.index') }}"
      logo="https://fluxui.dev/img/demo/logo.png"
      name="Gate Export"
    />
    <flux:brand
      class="hidden px-2 dark:flex"
      href="{{ route('home.index') }}"
      logo="https://fluxui.dev/img/demo/dark-mode-logo.png"
      name="Gate Export"
    />
    <flux:navlist variant="outline">
      <flux:navlist.item current href="{{ route('home.index') }}">
        {{ __('Home') }}
      </flux:navlist.item>

      @foreach ($navigationCategories as $category)
        <flux:navlist.group
          :expanded="false"
          expandable
          heading="{{ $category['name'] }}"
        >
          @foreach ($category['subcategories'] as $subcategory)
            <flux:navlist.item href="{{ route('categories.show', $subcategory['slug']) }}">
              {{ $subcategory['name'] }}
            </flux:navlist.item>
          @endforeach
        </flux:navlist.group>
      @endforeach

    </flux:navlist>
    <flux:spacer />
  </flux:sidebar>
  {{ $slot }}
  @fluxScripts
</body>

</html>
