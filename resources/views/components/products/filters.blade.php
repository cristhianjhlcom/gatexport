<aside class="bg-primary-500 overflow-hidden rounded-sm border border-gray-200 text-white">
  <ul>
    @if ($category->subcategories)
      <li x-data="{ open: 'true' }">
        <button
          @click="open = !open"
          class="hover:bg-primary-600 items-between flex w-full cursor-pointer items-center justify-between gap-4 p-2 font-extrabold"
          type="button"
        >
          <div class="flex items-center justify-start gap-2">
            {{-- <img
                alt="Icono"
                class="aspect-auto w-20 object-cover object-left"
                src="{{ Storage::disk('public')->url($category->image) }}"
                /> --}}
            <span>{{ $category->localizedName }}</span>
          </div>
          <flux:icon.chevron-right class="size-8" x-show="!open" />
          <flux:icon.chevron-down class="size-8" x-show="open" />
        </button>
        <ul class="text-primary-500 divide-y divide-gray-200 bg-white">
          @foreach ($category->subcategories as $subcategory)
            <li x-cloak x-show="open">
              <button
                class="hover:bg-primary-200 flex w-full cursor-pointer items-center justify-start gap-4 bg-white p-2"
                type="button"
                wire:click="filterBySubcategory({{ $subcategory->id }})"
              >
                {{-- <img
                    alt="Icono"
                    class="aspect-square object-contain"
                    height="35"
                    src="{{ Storage::disk('public')->url($subcategory->image) }}"
                    width="35"
                    /> --}}

                <flux:icon.plus size="6" />
                <span>{{ $subcategory->localizedName }}</span>
              </button>
            </li>
          @endforeach
          <li x-cloak x-show="open">
            <button
              class="hover:bg-primary-200 flex w-full cursor-pointer items-center justify-start gap-4 bg-white p-2"
              type="button"
              wire:click="filterByCategory({{ $category->id }})"
            >
              <flux:icon.plus size="6" />
              <span>Todos</span>
            </button>
          </li>
        </ul>
      </li>
    @endif
    <li>
      <button
        class="hover:bg-primary-600 items-between flex w-full cursor-pointer items-center justify-start gap-4 p-2 font-extrabold"
        type="button"
        wire:click="clearFilters"
      >
        <flux:icon.trash size="6" />
        <span>Limpiar Filtros</span>
      </button>
    </li>
  </ul>
</aside>
