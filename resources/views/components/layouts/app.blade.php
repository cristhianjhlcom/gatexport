<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WireFlux') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/css/app.css')
    @fluxStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc."
            class="max-lg:hidden dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc."
            class="max-lg:!hidden hidden dark:flex" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="#" current>
                {{ __('Home') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="mr-4">
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
        </flux:navbar>

        @auth
            <flux:dropdown position="top" align="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

                <flux:menu>
                    {{-- @can('see_dashboard') --}}
                    {{-- @if (auth()->user()->hasRole('admin'))
                        <flux:navmenu.item href="{{ route('dashboard') }}" icon="building-office">
                            {{ __('Dashboard') }}
                        </flux:navmenu.item>
                    @endif --}}
                    @role('admin')
                        <flux:navmenu.item href="{{ route('dashboard') }}" icon="building-office">
                            {{ __('Dashboard') }}
                        </flux:navmenu.item>
                    @endrole
                    <flux:navmenu.item href="{{ route('profile') }}" icon="user">
                        {{ __('Profile') }}
                    </flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="credit-card">
                        {{ __('Billing') }}
                    </flux:navmenu.item>
                    <flux:navmenu.item href="{{ route('logout') }}" icon="arrow-right-start-on-rectangle">
                        {{ __('Logout') }}
                    </flux:navmenu.item>
                </flux:menu>
            </flux:dropdown>
        @endauth

        @guest
            <flux:button href="/login">
                {{ __('Log In') }}
            </flux:button>
        @endguest
    </flux:header>

    <flux:sidebar stashable sticky
        class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc."
            class="px-2 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc."
            class="px-2 hidden dark:flex" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="#" current>
                {{ __('Home') }}
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>

    <flux:main container>
        <flux:heading size="xl" level="1">¡Welcome to WireFlux!</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            Basic Laravel starter kit with Livewire and Flux.
        </flux:subheading>
        <flux:separator variant="subtle" />
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>

</html>
