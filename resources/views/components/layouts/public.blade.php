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
      <flux:navbar.item href="#">
        {{ __('Categories') }}
      </flux:navbar.item>
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
      <flux:navlist.item href="#">
        {{ __('Categories') }}
      </flux:navlist.item>
    </flux:navlist>
    <flux:spacer />
  </flux:sidebar>
  {{ $slot }}
  @fluxScripts
</body>

</html>
