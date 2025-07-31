<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? config('app.name') }} | {{ config('app.name') }}</title>

  <!-- Paragraphs Fonts -->
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

  <!-- Headings Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link
    crossorigin
    href="https://fonts.gstatic.com"
    rel="preconnect"
  >
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet"
  >

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  <flux:header
    class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
    container
    sticky
  >
    <flux:sidebar.toggle
      class="lg:hidden"
      icon="bars-2"
      inset="left"
    />

    <flux:avatar
      :chevron="false"
      circle
      class="mr-4"
      src="{{ $companyLogos['small_logo'] }}"
    />

    <flux:navbar class="-mb-px max-lg:hidden">
      <flux:navbar.item href="{{ route('home.index') }}">
        {{ __('layouts.navigation.home') }}
      </flux:navbar.item>

      <flux:dropdown>
        <flux:navbar.item icon:trailing="chevron-down">
          {{ __('layouts.navigation.products') }}
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
                  <flux:heading>{{ $category['name'][app()->getLocale()] }}</flux:heading>
                </flux:button>

                <flux:popover class="max-w-[800px] p-0">
                  <div class="grid grid-cols-5 grid-rows-2 gap-2 p-2">
                    <!-- Imagen principal de categoría -->
                    <a class="relative col-span-3 row-span-1 h-[200px] overflow-hidden rounded-sm"
                      href="{{ route('categories.show', $category['slug']) }}"
                    >
                      <img
                        alt="{{ $category['name'][app()->getLocale()] }}"
                        class="h-full w-full object-cover"
                        src="{{ $category['image'] }}"
                      />
                      <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                      <h6 class="absolute bottom-3 left-3 text-lg font-bold text-white">
                        {{ $category['name'][app()->getLocale()] }}
                      </h6>
                    </a>

                    <!-- Subcategorías -->
                    @foreach ($category['subcategories'] as $index => $subcategory)
                      <a
                        class="{{ $index < 2 ? 'col-start-' . ($index + 4) : '' }} relative overflow-hidden rounded-sm"
                        href="{{ route('subcategories.index', [$category['slug'], $subcategory['slug']]) }}"
                        title="{{ $subcategory['name'][app()->getLocale()] }}"
                      >
                        <img
                          alt="{{ $subcategory['name'][app()->getLocale()] }}"
                          class="h-full w-full object-cover"
                          src="{{ $subcategory['image'] }}"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <h6 class="absolute bottom-2 left-2 text-xs font-semibold text-white">
                          {{ $subcategory['name'][app()->getLocale()] }}
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

      <flux:navbar.item href="{{ route('home.index') }}/#services">
        {{ __('layouts.navigation.services') }}
      </flux:navbar.item>

      <flux:navbar.item href="{{ route('about-us.index') }}">
        {{ __('layouts.navigation.about_us') }}
      </flux:navbar.item>

    </flux:navbar>
    <flux:spacer />

    <livewire:shared.search />

    <flux:dropdown align="start" position="top">
      <flux:profile
        name="{{ app()->getLocale() === 'es' ? __('layouts.navigation.es') : __('layouts.navigation.en') }}"
      />

      <flux:navmenu>
        @foreach (config('localization.locales') as $locale)
          <flux:navmenu.item href="{{ route('localization.update', $locale) }}">
            {{ __("layouts.navigation.{$locale}") }}
          </flux:navmenu.item>
        @endforeach
      </flux:navmenu>
    </flux:dropdown>

  </flux:header>
  <flux:sidebar
    class="border border-zinc-200 bg-zinc-50 lg:hidden rtl:border-l rtl:border-r-0 dark:border-zinc-700 dark:bg-zinc-900"
    stashable
    sticky
  >
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand href="{{ route('home.index') }}" name="Gate Export">
      <x-slot name="logo">
        <img
          alt="Gate Export"
          class="h-9 w-auto"
          src="{{ $companyLogos['small_logo'] }}"
        />
      </x-slot>
    </flux:brand>
    <flux:navlist variant="outline">
      <flux:navlist.item href="{{ route('home.index') }}">
        {{ __('layouts.navigation.home') }}
      </flux:navlist.item>

      <flux:navlist.item href="{{ route('about-us.index') }}">
        {{ __('layouts.navigation.services') }}
      </flux:navlist.item>

      <flux:navlist.item href="{{ route('about-us.index') }}">
        {{ __('layouts.navigation.about_us') }}
      </flux:navlist.item>

      @foreach ($navigationCategories as $category)
        <flux:navlist.group
          :expanded="false"
          expandable
          heading="{{ $category['name'][app()->getLocale()] }}"
        >
          @foreach ($category['subcategories'] as $subcategory)
            <flux:navlist.item href="{{ route('categories.show', $subcategory['slug']) }}">
              {{ $subcategory['name'][app()->getLocale()] }}
            </flux:navlist.item>
          @endforeach
        </flux:navlist.group>
      @endforeach

    </flux:navlist>
    <flux:spacer />
  </flux:sidebar>
  {{ $slot }}
  <x-footer />
  <flux:toast />

  <x-common.whatsapp-link />

  @fluxScripts
  @stack('scripts')
</body>

</html>
