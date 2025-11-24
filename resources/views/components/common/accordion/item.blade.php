@props([
    'title' => 'Título Falso',
    'subtitle' => 'Subtítulo Falso',
    'content' => 'Contenido de texto falso para el acordeón.',
    'icon' => '🛒',
    'id' => uniqid(), // ID único para que Alpine lo identifique
    'open' => false,
])

<details class="rounded-2xl bg-white p-4" name="services-accordion" x-bind:open="open" x-data="{ open: @json($open) }">
  <summary class="flex w-full cursor-pointer list-none items-center text-left focus:outline-none [&::-webkit-details-marker]:hidden"
    name="accordion-header" x-on:click.prevent="open = !open">
    <img alt="{{ $title }}" class="mr-4 h-10 w-10" src="{{ Storage::disk('public')->url($icon) }}">

    <h2 class="text-primary-400 text-md grow font-extrabold md:text-xl">
      {{ $title }}
    </h2>

    {{-- NOTE: ARROW UP --}}
    <flux:icon.chevron-up class="text-primary-400" size="8" x-show="open" />
    {{-- NOTE: ARROW DOWN --}}
    <flux:icon.chevron-down class="text-primary-400" size="8" x-show="!open" />
  </summary>
  <div class="space-y-4 pt-4 text-center">
    <div class="bg-primary-400 block h-0.5 w-full"></div>
    <h3 class="text-sm font-bold italic text-gray-600 md:text-[17px]">{{ $subtitle }}</h3>
    <p class="text-sm leading-snug text-gray-900 dark:text-gray-900">{!! $content !!}</p>
  </div>
</details>
