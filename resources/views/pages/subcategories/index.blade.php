<x-layouts.public :title="$subcategory->localizedName">
  <main class="container space-y-4 py-4">

    {{-- BREADCRUMBS --}}
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('layouts.navigation.home') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('categories.index') }}" separator="slash">
        {{ __('layouts.navigation.categories') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item
        href="{{ route('categories.show', [
            'category' => $subcategory->category,
        ]) }}"
        separator="slash"
      >
        {{ $subcategory->category->localizedName }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item separator="slash">
        {{ $subcategory->localizedName }}
      </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- END BREADCRUMBS --}}

    {{-- GRID OF PRODUCTS --}}
    @if (count($products) === 0)
      <section class="flex items-center justify-center md:min-h-[500px]">
        <h1 class="text-6xl font-bold text-gray-500">
          {{ __('pages.product.no_products') }}
        </h1>
      </section>
    @else
      <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:min-h-[500px] md:grid-cols-4 lg:grid-cols-5">
        @foreach ($products as $product)
          <x-common.product-card :$product />
        @endforeach
      </div>
    @endif

    {{-- END GRID OF PRODUCTS --}}

  </main>
</x-layouts.public>
