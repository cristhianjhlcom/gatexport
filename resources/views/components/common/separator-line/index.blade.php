@props([
    'color' => 'border-primary-500',
    'lineClasses' => 'border-t-2',
    'pointSize' => 'w-2 h-2',
    'pointColor' => 'bg-primary-500',
])

@php
  $class = 'flex items-center w-[250px]';
@endphp



<div {{ $attributes->merge(['class' => $class]) }} role="separator">
  {{-- Punto Izquierdo --}}
  <div class="{{ $pointSize }} {{ $pointColor }} flex-shrink-0 rounded-full"></div>

  {{-- Línea Separadora --}}
  <div class="{{ $lineClasses }} {{ $color }} flex-grow"></div>

  {{-- Punto Derecho --}}
  <div class="{{ $pointSize }} {{ $pointColor }} flex-shrink-0 rounded-full"></div>
</div>
