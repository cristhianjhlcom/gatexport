@props([
    'product' => null,
    'largeLayout' => false,
])

{{-- TODO: Aplicar que cambie de forma dinámica desde livewire. --}}
@if ($largeLayout)
  <article class="group w-full p-4">
    <div class="flex items-start justify-between gap-10">
      <div class="flex w-1/3 items-start">
        @if ($product->firstImage)
          <img
            alt="{{ $product->localizedName }}"
            class="aspect-square h-full w-full rounded-2xl object-contain transition-all duration-300 group-hover:rounded-none"
            src="{{ $product->firstImage }}"
          >
        @else
          <div class="flex h-[230px] w-full items-center justify-center rounded-sm border border-gray-50 bg-gray-50">
            <h4 class="flex items-center gap-x-4 text-xl font-bold text-gray-300">
              <flux:icon class="size-8" name="photo" />
              No Image
            </h4>
          </div>
        @endif
      </div>

      <div class="flex-1 space-y-8">
        <header class="space-y-2">
          <h3 class="text-primary-500 text-sm font-semibold italic md:text-[19px]">
            {{ $product->localizedName }}
          </h3>

          <div class="bg-primary-500 block h-0.5 w-full"></div>

          <div class="flex items-center justify-between">
            <h4 class="text-primary-500 text-sm font-extrabold uppercase md:text-[21px]">
              {{ $product->localizedSubcategoryName }}
            </h4>
            <span class="text-xs font-normal text-[#808080]">10 x 1.5 cm - 2.3 cm / MOQ 20 KG (BULK)</span>
          </div>
        </header>


        <div class="flex items-end justify-between gap-2">
          <div class="w-[350px] text-sm font-normal leading-relaxed text-gray-700">
            {!! str()->words($product->localizedDescription, 25) !!}
          </div>
          <a
            class="group-hover:bg-primary-400 rounded-4xl flex flex-1 items-center justify-center gap-4 bg-gray-200 px-4 py-2 text-center font-extrabold text-gray-500 group-hover:text-white"
            data-button
            href="{{ $product->showUrl }}"
          >

            <flux:icon.eye />
            <span>Seguir viendo</span>
          </a>
        </div>
      </div>
    </div>
  </article>
@else
  @if ($product)
    <article
      class="group min-h-[480px] overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:rounded-none hover:shadow-lg"
    >
      @if ($product->firstImage)
        <img
          alt="{{ $product->localizedName }}"
          class="aspect-square h-auto w-full rounded-2xl object-contain transition-all duration-300 group-hover:rounded-none"
          src="{{ $product->firstImage }}"
        >
      @else
        <div class="flex h-[230px] w-full items-center justify-center rounded-sm border border-gray-50 bg-gray-50">
          <h4 class="flex items-center gap-x-4 text-xl font-bold text-gray-300">
            <flux:icon class="size-8" name="photo" />
            No Image
          </h4>
        </div>
      @endif
      <div class="space-y-2 p-4 text-center">
        <h3 class="text-primary-500 text-sm font-semibold italic md:text-[19px]">
          {{ str()->words($product->localizedName, 3) }}
        </h3>
        <h4 class="text-primary-500 text-sm font-extrabold md:text-[21px]">
          {{ $product->localizedSubcategoryName }}
        </h4>
        <div>
          <span class="text-xs font-normal text-[#808080]">10 x 1.5 cm - 2.3 cm / MOQ 20 KG (BULK)</span>
        </div>

        <a
          class="bg-primary-500 rounded-4xl hidden items-center justify-center gap-4 px-4 py-2 text-center text-white group-hover:flex"
          data-button
          href="{{ $product->showUrl }}"
        >

          <flux:icon.eye />
          <span>Seguir viendo</span>
        </a>
      </div>
    </article>
  @endif
@endif
