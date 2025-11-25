@props(['url', 'title', 'src'])

@if (isset($url))
  <a href="{{ $url }}" title="{{ $title }}">
    <img
      {{ $attributes->class('aspect-auto w-full h-[30px]') }}
      alt="{{ $title }}"
      src="{{ $src }}"
    >
  </a>
@else
  <img
    {{ $attributes->class('aspect-auto w-full h-[30px]') }}
    alt="{{ $title }}"
    src="{{ $src }}"
  >
@endif
