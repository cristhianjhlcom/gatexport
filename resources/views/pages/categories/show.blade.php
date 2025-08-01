<x-layouts.public :title="$category->localizedName">
  <main class="container space-y-4 py-4">

    {{-- BREADCRUMBS --}}
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('layouts.navigation.home') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('categories.index') }}" separator="slash">
        {{ __('layouts.navigation.categories') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item separator="slash">
        {{ $category->localizedName }}
      </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- END BREADCRUMBS --}}

    {{-- GRID OF PRODUCTS --}}
    <div class="space-y-6">
      @foreach ($category->subcategories as $subcategory)
        <article class="space-y-4">
          <header class="flex w-full items-center justify-between">
            <x-heading level="2" size="sm">
              {{ $subcategory->localizedName }}
            </x-heading>
            <flux:button
              href="{{ route('subcategories.index', [
                  'category' => $category,
                  'subcategory' => $subcategory,
              ]) }}"
              icon:trailing="arrow-right"
              inset
              size="sm"
              variant="ghost"
              wire:navigate
            >
              {{ __('pages.categories.view_all') }}
            </flux:button>
          </header>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
            @foreach ($subcategory->products as $product)
              <x-common.product-card :$product />
            @endforeach
          </div>
        </article>
      @endforeach
    </div>
    {{-- END GRID OF PRODUCTS --}}

  </main>
</x-layouts.public>
