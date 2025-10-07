@props([
    'size' => 'base',
    'weight' => 'normal',
    'level' => '2',
    'variant' => 'primary',
])

@php
  $responsive_sizes = [
      'base' => 'text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl',
      'title' => 'text-xl sm:text-2xl md:text-3xl lg:text-4xl',
      'sub-title' => 'text-sm sm:text-xs md:text-[18px]',
      'accent' => 'text-sm sm:text-base md:text-lg lg:text-xl xl:text-[18px]',
  ];

  $variant_colors = [
      'primary' => 'text-primary-500',
      'secondary' => 'text-primary-600 dark:text-gray-100',
      'accent' => 'text-primary-400',
  ];

  $responsive_class = $responsive_sizes[$size] ?? $responsive_sizes['md'];
  $variant_class = $variant_colors[$variant] ?? $variant_colors['neutral'];
  $class = "leading-tight {$responsive_class} {$weight} {$variant_class}";
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
