@php
  $url = route($path);
  $isActive = request()->routeIs($path);
@endphp

<a
  @class([
      'border-b-4 border-primary-400 text-primary-400 font-bold' => $isActive,
      'flex h-full items-center text-sm uppercase transition',
  ])
  href="{{ $url }}"
  title=""
>
  {{ $text }}
</a>
