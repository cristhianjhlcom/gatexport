@php
  $url = route($path);
  $isActive = request()->routeIs($path);
  $isHomePage = request()->routeIs('home.index');
@endphp

<a
  @class([
      'border-b-4 border-white text-white font-bold' => $isHomePage && $isActive,
      'border-b-4 border-primary-400 text-primary-400' =>
          !$isHomePage && $isActive,
      'border-b-4 border-primary-400 text-primary-400 font-bold' => $isActive,
      'border-b-4 border-transparent' => !$isActive,
      'text-white font-semibold' => $isHomePage,
      'text-zinc-900 font-semibold' => !$isHomePage,
      'flex h-full items-center font-semibold text-md uppercase transition',
  ])
  href="{{ $url }}"
  title="{{ $text }}"
>
  {{ $text }}
</a>
