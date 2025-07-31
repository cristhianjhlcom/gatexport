@props([
    'product' => null,
])

@if ($product)
  <a href="{{ $product->showUrl }}" wire:navigate>
    <article>
      @if ($product->firstImage)
        {
        <img
          alt="{{ $product->localizedName }}"
          class="aspect-square h-auto w-full object-contain"
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
      <div class="space-y-2 py-2">
        <flux:breadcrumbs>
          <flux:breadcrumbs.item separator="slash">
            {{ $product->localizedCategoryName }}
          </flux:breadcrumbs.item>
          <flux:breadcrumbs.item separator="slash">
            {{ $product->localizedSubcategoryName }}
          </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <flux:heading size="sm">{{ $product->localizedName }}</flux:heading>
      </div>
    </article>
  </a>
@endif
