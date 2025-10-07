@props([
    'size' => 'base',
    'weight' => 'normal',
    'variant' => 'neutral',
])

@php
  $responsive_sizes = [
      'base' => 'text-[17px]',
  ];

  $variant_colors = [
      'base' => 'text-gray-900 dark:text-gray-50',
  ];

  $responsive_class = $responsive_sizes[$size] ?? $responsive_sizes['base'];
  $variant_class = $variant_colors[$variant] ?? $variant_colors['base'];
  $class = "leading-normal {$responsive_class} {$weight} {$variant_class}";
@endphp

<p {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</p>
