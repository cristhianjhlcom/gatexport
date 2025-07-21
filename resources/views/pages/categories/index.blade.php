<x-layouts.public>
  <main class="container space-y-4 py-4">

    {{-- BREADCRUMBS --}}
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('layouts.navigation.home') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item separator="slash">
        {{ __('layouts.navigation.categories') }}
      </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- END BREADCRUMBS --}}

    {{-- GRID OF PRODUCTS --}}
    <section class="flex flex-col space-y-8 divide-y divide-gray-200">
      @foreach ($categories as $category)
        <div class="space-y-4 pb-8">
          <header class="flex w-full items-center justify-between">
            <h2 class="text-xl font-semibold">{{ $category->name }}</h2>
            <flux:button
              href="{{ route('categories.show', [
                  'category' => $category,
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
          <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-4">
            @foreach ($category->subcategories as $subcategory)
              <a href="{{ route('subcategories.index', [
                  'category' => $category,
                  'subcategory' => $subcategory,
              ]) }}"
                wire:navigate
              >
                <article class="flex flex-col items-center justify-center">
                  <img
                    alt="{{ $subcategory->name }}"
                    class="aspect-square h-auto w-full object-contain"
                    src="{{ $subcategory->getImagePathAttribute() }}"
                  >
                </article>
              </a>
            @endforeach
          </div>
        </div>
      @endforeach
    </section>
    {{-- END GRID OF PRODUCTS --}}

  </main>
</x-layouts.public>
