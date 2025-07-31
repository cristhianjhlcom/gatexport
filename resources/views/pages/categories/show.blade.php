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
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-3">
      @foreach ($category->subcategories as $subcategory)
        <a href="{{ route('subcategories.index', [
            'category' => $category,
            'subcategory' => $subcategory,
        ]) }}"
          wire:navigate
        >
          <article class="flex flex-col items-center justify-center">
            <img
              alt="{{ $subcategory->localizedName }}"
              class="aspect-square h-auto w-full object-contain"
              src="{{ $subcategory->imageUrl }}"
            >
          </article>
        </a>
      @endforeach
    </div>
    {{-- END GRID OF PRODUCTS --}}

  </main>
</x-layouts.public>
