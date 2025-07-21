@props([
    'product' => null,
])

@if ($product)
  <a href="{{ route('products.show', [
      'category' => $product->subcategory->category,
      'subcategory' => $product->subcategory,
      'product' => $product,
  ]) }}"
    wire:navigate
  >
    <article>
      <img
        alt="{{ $product->name }}"
        class="aspect-square h-auto w-full object-contain"
        src="{{ $product->getFirstImageAttribute() }}"
      >
      <div class="space-y-2 py-2">
        <flux:breadcrumbs>
          <flux:breadcrumbs.item separator="slash">
            {{ $product->subcategory->category->name }}
          </flux:breadcrumbs.item>
          <flux:breadcrumbs.item separator="slash">
            {{ $product->subcategory->name }}
          </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <flux:heading size="sm">{{ $product->name }}</flux:heading>
      </div>
    </article>
  </a>
@endif
