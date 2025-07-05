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
      href="#"
      logo="https://fluxui.dev/img/demo/logo.png"
      name="Acme Inc."
    />
    <flux:brand
      class="max-lg:hidden! hidden dark:flex"
      href="#"
      logo="https://fluxui.dev/img/demo/dark-mode-logo.png"
      name="Acme Inc."
    />
    <flux:navbar class="-mb-px max-lg:hidden">
      <flux:navbar.item
        current
        href="{{ route('home.index') }}"
        icon="home"
      >
        {{ __('Home') }}
      </flux:navbar.item>
      <flux:navbar.item
        badge="12"
        href="{{ route('categories.index') }}"
        icon="inbox"
      >
        {{ __('Categories') }}
      </flux:navbar.item>
      <flux:separator
        class="my-2"
        variant="subtle"
        vertical
      />
    </flux:navbar>
    <flux:spacer />
    <flux:navbar class="me-4">
      <flux:navbar.item
        href="#"
        icon="magnifying-glass"
        label="Search"
      />
      <flux:navbar.item
        class="max-lg:hidden"
        href="#"
        icon="cog-6-tooth"
        label="Settings"
      />
      <flux:navbar.item
        class="max-lg:hidden"
        href="#"
        icon="information-circle"
        label="Help"
      />
    </flux:navbar>
    @auth
      <flux:dropdown align="start" position="top">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
        <flux:menu>
          <flux:menu.radio.group>
            <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
            <flux:menu.radio>Truly Delta</flux:menu.radio>
          </flux:menu.radio.group>
          <flux:menu.separator />
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <flux:menu.item icon="arrow-right-start-on-rectangle" type="submit">Logout</flux:menu.item>
          </form>
        </flux:menu>
      </flux:dropdown>
    @else
      <a class="flex items-center gap-2" href="{{ route('login') }}">
        {{ __('Login') }}
      </a>
      <a class="flex items-center gap-2" href="{{ route('register') }}">
        {{ __('Register') }}
      </a>
    @endauth
  </flux:header>
  <flux:sidebar
    class="border border-zinc-200 bg-zinc-50 lg:hidden rtl:border-l rtl:border-r-0 dark:border-zinc-700 dark:bg-zinc-900"
    stashable
    sticky
  >
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand
      class="px-2 dark:hidden"
      href="#"
      logo="https://fluxui.dev/img/demo/logo.png"
      name="Acme Inc."
    />
    <flux:brand
      class="hidden px-2 dark:flex"
      href="#"
      logo="https://fluxui.dev/img/demo/dark-mode-logo.png"
      name="Acme Inc."
    />
    <flux:navlist variant="outline">
      <flux:navlist.item
        current
        href="#"
        icon="home"
      >Home</flux:navlist.item>
      <flux:navlist.item
        badge="12"
        href="#"
        icon="inbox"
      >Inbox</flux:navlist.item>
      <flux:navlist.item href="#" icon="document-text">Documents</flux:navlist.item>
      <flux:navlist.item href="#" icon="calendar">Calendar</flux:navlist.item>
      <flux:navlist.group
        class="max-lg:hidden"
        expandable
        heading="Favorites"
      >
        <flux:navlist.item href="#">Marketing site</flux:navlist.item>
        <flux:navlist.item href="#">Android app</flux:navlist.item>
        <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
      </flux:navlist.group>
    </flux:navlist>
    <flux:spacer />
    <flux:navlist variant="outline">
      <flux:navlist.item href="#" icon="cog-6-tooth">Settings</flux:navlist.item>
      <flux:navlist.item href="#" icon="information-circle">Help</flux:navlist.item>
    </flux:navlist>
  </flux:sidebar>
  <flux:main container>
    {{ $slot }}
  </flux:main>
  @fluxScripts
</body>

</html>
