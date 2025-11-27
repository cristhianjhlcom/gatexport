<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags :title="__('layouts.navigation.categories')" />
  </x-slot>

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
    <section class="flex flex-col">
      @foreach ($categories as $category)
        @if (count($category->subcategories) > 0)
          <div class="space-y-2 pb-4">
            <header class="flex w-full items-center justify-between">
              <h2 class="text-primary-700 text-xl font-semibold">{{ $category->localizedName }}</h2>
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
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
              @foreach ($category->subcategories as $subcategory)
                <a href="{{ route('subcategories.index', [
                    'category' => $category,
                    'subcategory' => $subcategory,
                ]) }}"
                  wire:navigate
                >
                  <article class="bg-primary-100 flex flex-col items-start justify-center overflow-hidden rounded-sm">
                    <img
                      alt="{{ $subcategory->localizedName }}"
                      class="aspect-square h-auto w-full object-contain"
                      src="{{ $subcategory->imageUrl }}"
                    >
                    <h2>
                      <flux:heading class="text-primary-700 p-2 text-center text-sm font-semibold">
                        {{ $subcategory->localizedName }}
                      </flux:heading>
                    </h2>
                  </article>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach
    </section>
    {{-- END GRID OF PRODUCTS --}}

  </main>
</x-layouts.public>
