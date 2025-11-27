<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="light" name="color-scheme">

  {{ $seo ?? null }}

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
  {{-- @fluxAppearance --}}

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

<body class="bg-primary-50 dark:bg-primary-50 min-h-screen text-gray-900 antialiased dark:text-gray-900">
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

  {{ $slot }}

  @fluxScripts
  @stack('scripts')
</body>

</html>
