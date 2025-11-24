@props(['url', 'label'])

@if (!empty($url))
  <a aria-label="{{ $label }}" href="{{ $url }}">{{ $slot }}</a>
@endif
