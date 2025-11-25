@props(['url', 'title', 'src'])

@if (isset($url))
  <a href="{{ $url }}" title="{{ $title }}">
    <img
      {{ $attributes->class('aspect-square size-10') }}
      alt="{{ $title }}"
      src="{{ $src }}"
    >
  </a>
@else
  <img
    {{ $attributes->class('aspect-square size-10') }}
    alt="{{ $title }}"
    src="{{ $src }}"
  >
@endif
