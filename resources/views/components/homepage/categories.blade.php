@props([
    'categories' => [],
])

<section class="bg-primary-50 py-10 md:py-14 dark:bg-gray-800">

  <div class="container space-y-16 overflow-hidden">

    <header class="flex flex-col space-y-4">
      <x-common.title
        class="text-center"
        level="2"
        size="title"
        weight="font-extrabold"
      >
        {{ __('pages.home.products.title') }}
      </x-common.title>
      <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
    </header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">

      {{-- 1. PALO SANTO: col-span-2 en mobile, col-span-1 en desktop. Altura completa. --}}
      <div class="relative col-span-2 flex h-[30rem] items-end overflow-hidden bg-[#d5b99f] p-6 lg:col-span-1">
        {{-- Aquí va tu imagen de fondo --}}
        <img
          alt="Palo Santo"
          class="absolute inset-0 h-full w-full object-cover opacity-80 mix-blend-multiply"
          src="http://127.0.0.1:8000/storage/uploads/about/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp"
        >
        {{-- <div class="z-10 text-white md:text-black">
          <h2 class="text-4xl font-bold tracking-tight md:text-5xl">PALO SANTO</h2>
          <p class="mt-2 text-xl font-semibold md:text-2xl">De origen sustentable</p>
        </div> --}}
      </div>

      {{-- 2. INCIENSOS: col-span-2 en mobile, col-span-1 en desktop. Altura completa. --}}
      <div class="relative col-span-2 flex h-[30rem] items-end overflow-hidden bg-[#86b5b5] p-6 lg:col-span-1">
        {{-- Aquí va tu imagen de fondo --}}
        <img
          alt="Palo Santo"
          class="absolute inset-0 h-full w-full object-cover opacity-80 mix-blend-multiply"
          src="http://127.0.0.1:8000/storage/uploads/about/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp"
        >
        {{-- <div class="z-10 text-white">
          <h2 class="text-4xl font-bold tracking-tight md:text-5xl">INCIENSOS</h2>
          <p class="mt-2 text-xl font-semibold md:text-2xl">Aromas 100%</p>
        </div> --}}
      </div>

      {{--
           3 y 4. CONTENEDOR DE BLOQUES PEQUEÑOS (Smudge Pop y Smudge Stick)
           Esto asegura que ambos ocupen el espacio de la tercera columna en desktop.
        --}}
      <div class="col-span-2 flex flex-col gap-4 lg:col-span-1">

        {{-- 3. SMUDGE POP: Ocupa la mitad superior de la columna 3 en desktop. --}}
        <div class="relative col-span-2 flex h-[14.5rem] items-end overflow-hidden bg-[#a37976] p-4 lg:col-span-1">
          {{-- Aquí va tu imagen de fondo --}}
          <img
            alt="Palo Santo"
            class="absolute inset-0 h-full w-full object-cover opacity-80 mix-blend-multiply"
            src="http://127.0.0.1:8000/storage/uploads/about/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp"
          >
          {{-- <div class="z-10 text-white">
            <h3 class="text-3xl font-bold tracking-tight">SMUDGE POP</h3>
            <p class="mt-1 text-xl font-semibold">Orgánico</p>
          </div> --}}
        </div>

        {{-- 4. SMUDGE STICK: Ocupa la mitad inferior de la columna 3 en desktop. --}}
        <div class="relative col-span-2 flex h-[14.5rem] items-end overflow-hidden bg-[#a5c58a] p-4 lg:col-span-1">
          {{-- Aquí va tu imagen de fondo --}}
          <img
            alt="Palo Santo"
            class="absolute inset-0 h-full w-full object-cover opacity-80 mix-blend-multiply"
            src="http://127.0.0.1:8000/storage/uploads/about/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp"
          >
          {{-- <div class="z-10 text-white">
            <h3 class="text-3xl font-bold tracking-tight">SMUDGE STICK</h3>
            <p class="mt-1 text-xl font-semibold">Orgánico</p>
          </div> --}}
        </div>
      </div>

    </div>

  </div>
</section>
