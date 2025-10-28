<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? config('app.name') }} | {{ config('app.name') }}</title>

  <!-- Paragraphs Fonts -->
  {{-- <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" /> --}}

  <!-- Headings Fonts -->
  {{-- <link href="https://fonts.googleapis.com" rel="preconnect">
  <link
    crossorigin
    href="https://fonts.gstatic.com"
    rel="preconnect"
  >
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet"
  > --}}
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link
    crossorigin
    href="https://fonts.gstatic.com"
    rel="preconnect"
  >
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet"
  >
  <!-- #End Headings Fonts -->

  @production
    <link
      href="/apple-touch-icon.png"
      rel="apple-touch-icon"
      sizes="180x180"
    >
    <link
      href="/favicon-32x32.png"
      rel="icon"
      sizes="32x32"
      type="image/png"
    >
    <link
      href="/favicon-16x16.png"
      rel="icon"
      sizes="16x16"
      type="image/png"
    >
    <link href="/site.webmanifest" rel="manifest">
  @endproduction

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @stack('styles')
  @fluxAppearance

  @production
    <!-- Google Tag Manager -->
    <script>
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })
      (window, document, 'script', 'dataLayer', 'GTM-5RWFMC2S');
    </script>
    <!-- End Google Tag Manager -->
  @endproduction
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  @production
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
        height="0"
        src="https://www.googletagmanager.com/ns.html?id=GTM-5RWFMC2S"
        style="display:none;visibility:hidden"
        width="0"
      ></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  @endproduction
  <flux:header
    class="dark:bg-primary-600 dark:border-primary-600 z-50 border-b border-zinc-200 bg-zinc-50"
    container
    sticky
  >
    <flux:sidebar.toggle
      class="lg:hidden"
      icon="bars-2"
      inset="left"
    />

    <a href="{{ route('home.index') }}">
      <img
        alt="{{ config('app.name') }}"
        class="mr-4 aspect-square h-10 w-10"
        src="{{ $companyLogos['small_logo'] }}"
      />
    </a>

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
                  <div
                    class="{{ count($category['subcategories']) > 3 ? 'grid-rows-2' : 'grid-rows-1' }} grid grid-cols-5 gap-2 p-2"
                  >
                    <!-- Imagen principal de categoría -->
                    <a class="bg-primary-500 relative col-span-3 row-span-1 h-[200px] w-full overflow-hidden rounded-sm"
                      href="{{ route('categories.show', $category['slug']) }}"
                    >
                      <img
                        alt="{{ $category['name'][app()->getLocale()] }}"
                        class="aspect-auto h-full w-full min-w-[450px] object-cover"
                        src="{{ $category['image'] }}"
                      />
                      <h6 class="text-primary-900 absolute bottom-3 left-3 text-lg font-bold">
                        {{ $category['name'][app()->getLocale()] }}
                      </h6>
                    </a>

                    @if (count($category['subcategories']) < 3)
                      @foreach ($category['subcategories'] as $index => $subcategory)
                        <a
                          class="bg-primary-500 relative col-span-2 col-start-4 h-[200px] w-[150px] overflow-hidden rounded-sm"
                          href="{{ route('subcategories.index', [$category['slug'], $subcategory['slug']]) }}"
                          title="{{ $subcategory['name'][app()->getLocale()] }}"
                        >
                          <img
                            alt="{{ $subcategory['name'][app()->getLocale()] }}"
                            class="h-full min-h-[200px] w-full min-w-[150px] object-cover"
                            src="{{ $subcategory['image'] }}"
                          />
                          <h6
                            class="text-secondary-500 text-primary-900 absolute bottom-2 left-2 text-sm font-semibold">
                            {{ $subcategory['name'][app()->getLocale()] }}
                          </h6>
                        </a>
                      @endforeach
                    @else
                      <!-- Subcategorías -->
                      @foreach ($category['subcategories'] as $index => $subcategory)
                        <a
                          class="{{ $index < 2 ? 'col-start-' . ($index + 4) : '' }} bg-primary-500 relative overflow-hidden rounded-sm"
                          href="{{ route('subcategories.index', [$category['slug'], $subcategory['slug']]) }}"
                          title="{{ $subcategory['name'][app()->getLocale()] }}"
                        >
                          <img
                            alt="{{ $subcategory['name'][app()->getLocale()] }}"
                            class="h-full w-full min-w-[150px] object-cover"
                            src="{{ $subcategory['image'] }}"
                          />
                          <h6 class="text-primary-900 absolute bottom-2 left-2 text-sm font-semibold">
                            {{ $subcategory['name'][app()->getLocale()] }}
                          </h6>
                        </a>
                      @endforeach
                    @endif
                  </div>
                </flux:popover>
              </flux:dropdown>
            @endforeach
          </div>
        </flux:navmenu>
      </flux:dropdown>

      <flux:navbar.item href="{{ route('about-us.index') }}">
        {{ __('layouts.navigation.about_us') }}
      </flux:navbar.item>

      <flux:navbar.item href="{{ route('services.index') }}">
        {{ __('layouts.navigation.services') }}
      </flux:navbar.item>

    </flux:navbar>
    <flux:spacer />

    <x-common.locale-switch />

    <livewire:shared.search />
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
