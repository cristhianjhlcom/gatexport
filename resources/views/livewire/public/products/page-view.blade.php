<main>
  <header>
    <img
      alt="{{ $details['altText'] }}"
      class="aspect-auto h-80 w-full object-cover object-center"
      src="{{ asset("storage/{$details['backgroundImage']}") }}"
    />
  </header>

  <div class="container space-y-4 py-10">
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="w-full max-w-[250px]">
        <aside class="bg-primary-500 border-primary-500 overflow-hidden rounded-sm border text-white">
          <ul>
            @foreach ($categories as $category)
              @if ($category->subcategories)
                <li x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                  <button
                    @click="open = !open"
                    class="hover:bg-primary-600 items-between flex max-h-14 w-full cursor-pointer items-center justify-between gap-4 p-2 font-extrabold"
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
                          class="hover:bg-primary-200 bg-primary-100 flex max-h-14 w-full cursor-pointer items-center justify-start gap-4 p-2"
                          type="button"
                          wire:click="filterBySubcategory({{ $subcategory->id }})"
                        >
                          <img
                            alt="Icono"
                            class="aspect-square object-contain"
                            height="35"
                            src="{{ Storage::disk('public')->url($subcategory->image) }}"
                            width="35"
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

      <div class="flex-1 space-y-6">
        <header class="flex items-center justify-between pb-4">
          <div>
            <button>
              <flux:icon.view-columns class="rotate-90 text-gray-500" variant="solid" />
            </button>
            <button>
              <flux:icon.view-columns class="text-gray-500" variant="solid" />
            </button>
          </div>
          <div class="flex w-1/2 items-center justify-end gap-2">
            <span class="flex-1 text-right">Ordenar por</span>
            <flux:select
              class="flex-1/4"
              placeholder="Clasificación..."
              size="sm"
            >
              <flux:select.option selected>Clasificación por defecto</flux:select.option>
              <flux:select.option>Último agregado</flux:select.option>
            </flux:select>
          </div>
        </header>

        {{-- <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3"> --}}
        <div class="grid grid-cols-1 gap-6 divide-y divide-gray-200">
          @foreach ($products as $product)
            <x-common.product-card :$product :largeLayout="true" />
          @endforeach
        </div>

        {{ $products->links('components.common.pagination.index') }}
      </div>
    </div>
  </div>

  <div class="bg-primary-50 p-6">
    <div class="container space-y-4">
      <section class="special-content space-y-4 rounded-3xl bg-white p-10">
        {!! $details['description'] !!}
      </section>
    </div>
  </div>
</main>
