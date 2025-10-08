@props([
    'title' => 'Título Falso',
    'subtitle' => 'Subtítulo Falso',
    'content' => 'Contenido de texto falso para el acordeón.',
    'icon' => '🛒',
    'id' => uniqid(), // ID único para que Alpine lo identifique
    'open' => false,
])

{{-- <details name="acordeon" open>
  <summary>Sección 1</summary>
  <div>
    Este es el contenido del primer acordeón.
  </div>
</details> --}}

<details
  {{-- open="{{ isOpen }}" --}}
  {{-- x-bind:open="isOpen" --}}
  class="rounded-2xl bg-white p-4"
  name="services-accordion"
  open="true"
  x-data="{
      get isOpen() { return $parent.openId === '{{ $id }}' },
      handleClick() {
          $parent.open('{{ $id }}');
      }
  }"
>
  <summary
    :class="{ 'border-amber-600': isOpen }"
    class="flex w-full cursor-pointer list-none items-center text-left focus:outline-none [&::-webkit-details-marker]:hidden"
    name="accordion-header"
  >
    <span class="mr-4 text-2xl text-amber-600">{{ $icon }}</span>
    <h2 class="text-primary-400 text-md flex-grow font-extrabold md:text-2xl">{{ $title }}</h2>

    <svg
      :class="{ 'hidden': isOpen, 'block': !isOpen }"
      class="text-primary-400 size-6"
      fill="none"
      stroke-width="1.5"
      stroke="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="m4.5 15.75 7.5-7.5 7.5 7.5"
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
