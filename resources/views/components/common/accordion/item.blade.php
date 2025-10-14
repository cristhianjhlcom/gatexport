@props([
    'title' => 'Título Falso',
    'subtitle' => 'Subtítulo Falso',
    'content' => 'Contenido de texto falso para el acordeón.',
    'icon' => '🛒',
    'id' => uniqid(), // ID único para que Alpine lo identifique
    'open' => false,
])

<details
  class="rounded-2xl bg-white p-4"
  name="services-accordion"
  x-bind:open="open"
  x-data="{ open: @json($open) }"
>
  <summary
    class="flex w-full cursor-pointer list-none items-center text-left focus:outline-none [&::-webkit-details-marker]:hidden"
    name="accordion-header"
    x-on:click.prevent="open = !open"
  >
    <img
      alt="{{ $title }}"
      class="mr-4 h-10 w-10"
      src="{{ Storage::disk('public')->url($icon) }}"
    >

    <h2 class="text-primary-400 text-md flex-grow font-extrabold md:text-xl">
      {{ $title }}
    </h2>

    {{-- NOTE: ARROW UP --}}
    <svg
      class="text-primary-400 size-6"
      fill="none"
      stroke-width="1.5"
      stroke="currentColor"
      viewBox="0 0 24 24"
      x-show="open"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="m4.5 15.75 7.5-7.5 7.5 7.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    </svg>

    {{-- NOTE: ARROW DOWN --}}
    <svg
      class="text-primary-400 size-6"
      fill="none"
      stroke-width="1.5"
      stroke="currentColor"
      viewBox="0 0 24 24"
      x-show="!open"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="m19.5 8.25-7.5 7.5-7.5-7.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    </svg>

  </summary>
  <div class="space-y-4 pt-4 text-center">
    <div class="bg-primary-400 block h-0.5 w-full"></div>
    <h3 class="text-sm font-bold italic text-gray-600 md:text-[17px]">{{ $subtitle }}</h3>
    <p class="text-sm leading-snug">{!! $content !!}</p>
  </div>
</details>
