@props([
    'size' => 'base',
    'weight' => 'normal',
    'level' => '2',
    'variant' => 'neutral',
])

@php
  $responsive_sizes = [
      'xs' => 'text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl',
      'sm' => 'text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl',
      'md' => 'text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl',
      'lg' => 'text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl',
      'xl' => 'text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl',
      '2xl' => 'text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl',
  ];

  $variant_colors = [
      'primary' => 'text-primary-500',
      'accent' => 'text-primary-500',
      'neutral' => 'text-gray-900 dark:text-gray-100',
      'info' => 'text-blue-500',
      'success' => 'text-green-500',
      'warning' => 'text-yellow-500',
      'danger' => 'text-red-500',
      'white' => 'text-white dark:text-gray-100',
  ];

  $responsive_class = $responsive_sizes[$size] ?? $responsive_sizes['md'];
  $variant_class = $variant_colors[$variant] ?? $variant_colors['neutral'];
  $class = "font-display leading-tight {$responsive_class} font-{$weight} {$variant_class}";
@endphp

@switch($level)
  @case('1')
    <h1 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h1>
  @break

  @case('2')
    <h2 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h2>
  @break

  @case('3')
    <h3 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h3>
  @break

  @case('4')
    <h4 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h4>
  @break

  @case('5')
    <h5 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h5>
  @break

  @case('6')
    <h6 {{ $attributes->merge(['class' => $class]) }}>
      {{ $slot }}
    </h6>
  @break

  @default
    <span {{ $attributes->merge(['class' => "$size $weight $color"]) }}>
      {{ $slot }}
    </span>
  @break
@endswitch
