@props([
    'product' => null,
])

@if ($product)
  <article
    class="group overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:rounded-none hover:shadow-lg"
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
