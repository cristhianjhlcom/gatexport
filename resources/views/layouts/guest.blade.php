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

<body class="bg-white dark:bg-zinc-900 antialiased min-h-screen">
    <div class="py-8 flex justify-center items-center min-h-screen">
        <div class="w-11/12 max-w-md space-y-6">
            {{ $slot }}
        </div>
    </div>
    @fluxScripts
</body>

</html>
