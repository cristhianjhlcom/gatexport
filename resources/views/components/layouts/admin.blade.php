<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf-token">

  <title>{{ $title ?? __('Administración') }}</title>

  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  @fluxAppearance
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-800">
  <flux:sidebar
    class="border-r border-zinc-200 bg-zinc-50 rtl:border-l rtl:border-r-0 dark:border-zinc-700 dark:bg-zinc-900"
    stashable
    sticky
  >
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="{{ route('home.index') }}" name="Gate Export">
      <x-slot name="logo">
        <img
          alt="Gate Export SAC"
          class="h-9 w-auto"
          src="{{ $companyLogos['small_logo'] }}"
        />
      </x-slot>
    </flux:brand>

    <flux:separator />
    <flux:navlist variant="outline">
      <flux:navlist.item href="{{ route('home.index') }}" icon="home">
        Inicio
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $ordersCount }}"
        href="{{ route('admin.orders.index') }}"
        icon="wallet"
      >
        Ordenes
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $productsCount }}"
        href="{{ route('admin.products.index') }}"
        icon="cube"
      >
        Productos
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $categoriesCount }}"
        href="{{ route('admin.categories.index') }}"
        icon="folder"
      >
        Categorías
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $subcategoriesCount }}"
        href="{{ route('admin.subcategories.index') }}"
        icon="folder"
      >
        Sub-categorías
      </flux:navlist.item>
      <flux:navlist.item
        badge="{{ $usersCount }}"
        href="{{ route('admin.users.index') }}"
        icon="user"
      >
        Usuarios
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.articles.index') }}" icon="folder">
        Articles
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.faqs.index') }}" icon="clipboard-document-check">
        FAQs
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.policies.index') }}" icon="trophy">
        Políticas
      </flux:navlist.item>
    </flux:navlist>
    <flux:spacer />

    <flux:navlist.group expandable heading="{{ __('Settings') }}">
      <flux:navlist.item href="{{ route('admin.settings.general') }}">
        General
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.settings.about') }}">
        Historia
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.settings.banners') }}">
        Banners
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.settings.services') }}">
        Servicios
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.settings.advantages') }}">
        Ventajas
      </flux:navlist.item>
      <flux:navlist.item href="{{ route('admin.settings.countries') }}">
        Países
      </flux:navlist.item>
    </flux:navlist.group>

    @auth
      <flux:dropdown
        align="start"
        class="max-lg:hidden"
        position="top"
      >

        @if (isset(auth()->user()->profile))
          <flux:profile name="{{ auth()->user()->profile->full_name }}" />
        @else
          <flux:profile name="" />
        @endif

        <flux:menu>
          <flux:menu.item href="#" icon="cog-6-tooth">
            Configuración
          </flux:menu.item>
          <flux:menu.separator />
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <flux:menu.item icon="arrow-right-start-on-rectangle" type="submit">
              Cerrar Sesión
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
      @if (isset(auth()->user()->profile))
        <flux:profile avatar:name="{{ auth()->user()->profile->full_name }}" />
      @else
        <flux:profile avatar:name="" />
      @endif
      <flux:menu>
        <flux:menu.item href="#" icon="cog-6-tooth">
          Configuración
        </flux:menu.item>
        <flux:menu.separator />
        <flux:menu.item icon="arrow-right-start-on-rectangle">
          Cerrar Sesión
        </flux:menu.item>
      </flux:menu>
    </flux:dropdown>
  </flux:header>

  <flux:main>
    {{ $slot }}
  </flux:main>

  @persist('toast')
    <flux:toast />
  @endpersist

  @fluxScripts
</body>

</html>
