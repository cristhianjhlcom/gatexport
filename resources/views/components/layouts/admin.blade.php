<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf-token">

  <title>{{ $title ?? __('Adminitration') }}</title>

  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  <flux:sidebar
    class="border-r border-zinc-200 bg-zinc-50 rtl:border-l rtl:border-r-0 dark:border-zinc-700 dark:bg-zinc-900"
    stashable
    sticky
  >
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand
      class="px-2 dark:hidden"
      href="#"
      logo="https://fluxui.dev/img/demo/logo.png"
      name="Gate Export"
    />
    <flux:brand
      class="hidden px-2 dark:flex"
      href="#"
      logo="https://fluxui.dev/img/demo/dark-mode-logo.png"
      name="Gate Export"
    />
    {{--
    <flux:input
      as="button"
      icon="magnifying-glass"
      placeholder="{{ __('Search') }}..."
      variant="filled"
    />
    --}}
    <flux:separator />
    <flux:navlist variant="outline">
      <flux:navlist.item href="{{ route('home.index') }}" icon="home">
        {{ __('Home') }}
      </flux:navlist.item>
      <flux:navlist.item
        badge="0"
        href="{{ route('admin.orders.index') }}"
        icon="wallet"
      >
        {{ __('Orders') }}
      </flux:navlist.item>
      <flux:navlist.item
        badge="0"
        href="{{ route('admin.products.index') }}"
        icon="cube"
      >
        {{ __('Products') }}
      </flux:navlist.item>
      <flux:navlist.item
        badge="0"
        href="{{ route('admin.categories.index') }}"
        icon="folder"
      >
        {{ __('Categories') }}
      </flux:navlist.item>
      <flux:navlist.item
        badge="0"
        href="{{ route('admin.subcategories.index') }}"
        icon="folder"
      >
        {{ __('Sub Categories') }}
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $usersCount }}"
        href="{{ route('admin.users.index') }}"
        icon="user"
      >
        {{ __('Users') }}
      </flux:navlist.item>
    </flux:navlist>
    <flux:spacer />

    <flux:navlist variant="outline">
      <flux:navlist.item href="{{ route('admin.settings.index') }}" icon="cog-6-tooth">
        {{ __('Settings') }}
      </flux:navlist.item>
    </flux:navlist>
    @auth
      <flux:dropdown
        align="start"
        class="max-lg:hidden"
        position="top"
      >
        <flux:profile name="{{ auth()->user()->profile->full_name }}" />

        <flux:menu>
          <flux:menu.item href="#" icon="cog-6-tooth">
            {{ __('Settings') }}
          </flux:menu.item>
          <flux:menu.separator />
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <flux:menu.item icon="arrow-right-start-on-rectangle" type="submit">
              {{ __('Logout') }}
            </flux:menu.item>
          </form>
        </flux:menu>
      </flux:dropdown>
    @endauth
  </flux:sidebar>
  <flux:header class="lg:hidden">
    <flux:sidebar.toggle
      class="lg:hidden"
      icon="bars-2"
      inset="left"
    />
    <flux:spacer />
    <flux:dropdown alignt="start" position="top">
      <flux:profile avatar:name="{{ auth()->user()->profile->full_name }}" />
      <flux:menu>
        <flux:menu.item href="#" icon="cog-6-tooth">
          {{ __('Settings') }}
        </flux:menu.item>
        <flux:menu.separator />
        <flux:menu.item icon="arrow-right-start-on-rectangle">
          {{ __('Logout') }}
        </flux:menu.item>
      </flux:menu>
    </flux:dropdown>
  </flux:header>
  <flux:main>
    {{ $slot }}
  </flux:main>
  <flux:toast />

  @fluxScripts
</body>

</html>
