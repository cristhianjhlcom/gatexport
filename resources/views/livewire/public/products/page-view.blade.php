<main class="container space-y-4 py-4">
  <div class="flex flex-col gap-4 md:flex-row">
    <div class="w-full max-w-[250px]">
      <aside class="bg-primary-500 border-primary-500 overflow-hidden rounded-sm border text-white">
        <ul>
          @foreach ($categories as $category)
            @if ($category->subcategories)
              <li x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                <button
                  @click="open = !open"
                  class="hover:bg-primary-600 items-between flex w-full cursor-pointer items-center justify-between gap-4 p-2 font-extrabold"
                  type="button"
                >
                  <div class="flex items-center justify-start gap-2">
                    <img
                      alt="Icono"
                      class="aspect-square object-contain"
                      height="45"
                      src="{{ Storage::disk('public')->url($category->image) }}"
                      width="45"
                    />
                    <span>{{ $category->localizedName }}</span>
                  </div>
                  <flux:icon.chevron-right class="size-8" x-show="!open" />
                  <flux:icon.chevron-down class="size-8" x-show="open" />
                </button>
                <ul class="text-primary-500 divide-y bg-white">
                  @foreach ($category->subcategories as $subcategory)
                    <li x-cloak x-show="open">
                      <button
                        class="hover:bg-primary-200 bg-primary-100 flex w-full cursor-pointer items-center justify-start gap-4 p-2"
                        type="button"
                        wire:click="filterBySubcategory({{ $subcategory->id }})"
                      >
                        <img
                          alt="Icono"
                          class="aspect-square object-contain"
                          height="25"
                          src="{{ Storage::disk('public')->url($subcategory->image) }}"
                          width="25"
                        />
                        <span>{{ $subcategory->localizedName }}</span>
                      </button>
                    </li>
                  @endforeach
                  <li x-cloak x-show="open">
                    <button
                      class="hover:bg-primary-200 bg-primary-100 flex w-full cursor-pointer items-center justify-start gap-4 p-2"
                      type="button"
                      wire:click="filterByCategory({{ $category->id }})"
                    >
                      Todos
                    </button>
                  </li>
                </ul>
              </li>
            @endif
          @endforeach
        </ul>
      </aside>
    </div>
    <div class="grid flex-1 grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
      @foreach ($products as $product)
        <x-common.product-card :$product />
      @endforeach
    </div>
  </div>
</main>
