<main>
  @if (isset($details['altText']))
    <header>
      <img
        alt="{{ $details['altText'] }}"
        class="aspect-auto h-80 w-full object-cover object-center"
        src="{{ asset("storage/{$details['backgroundImage']}") }}"
      />
    </header>
  @endif

  <div class="container space-y-4 py-10">
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="w-full md:max-w-[250px]">
        <aside class="bg-primary-500 overflow-hidden rounded-sm border border-gray-200 text-white">
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
                        class="aspect-auto h-8 w-8 object-contain object-left"
                        src="{{ Storage::disk('public')->url($category->icon_white) }}"
                      />
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
                            class="aspect-auto h-8 w-8 object-contain object-left"
                            src="{{ Storage::disk('public')->url($subcategory->image) }}"
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
            @endforeach
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
      </div>

      <div class="flex-1 space-y-6" x-data="{ view: 'grid' }">
        <header class="hidden items-center justify-between pb-4 md:flex">
          <div
            aria-label="Vista de productos"
            class="flex items-center gap-2"
            role="tablist"
          >
            <button
              class="rounded p-2"
              title="Vista en cuadrícula"
              type="button"
              x-bind:aria-pressed="view === 'grid' ? 'true' : 'false'"
              x-bind:class="view === 'grid' ? 'text-primary-600 bg-primary-50' : 'text-gray-500'"
              x-on:click="view = 'grid'"
            >
              <flux:icon.view-columns class="" variant="solid" />
              <span class="sr-only">Cuadrícula</span>
            </button>

            <button
              class="rounded p-2"
              title="Vista en lista"
              type="button"
              x-bind:aria-pressed="view === 'list' ? 'true' : 'false'"
              x-bind:class="view === 'list' ? 'text-primary-600 bg-primary-50' : 'text-gray-500'"
              x-on:click="view = 'list'"
            >
              <flux:icon.view-columns class="rotate-90" variant="solid" />
              <span class="sr-only">Lista</span>
            </button>
          </div>
          <div class="flex w-1/2 items-center justify-end gap-2">
            <span class="flex-1 text-right">Ordenar por</span>
            <flux:select
              class="flex-1/4"
              placeholder="Clasificación..."
              size="sm"
              wire:model="sort"
            >
              <flux:select.option value="">Clasificación por defecto</flux:select.option>
              <flux:select.option value="latest">Último agregado</flux:select.option>
            </flux:select>
          </div>
        </header>

        <div
          class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3"
          x-cloak
          x-show="view === 'grid'"
          x-transition
        >
          @forelse ($products as $product)
            <x-common.product-card :$product />
          @empty
            <h2 class="text-primary-400 text-3xl font-extrabold">No hay productos</h2>
          @endforelse
        </div>

        <div
          class="grid grid-cols-1 gap-6 divide-y divide-gray-200"
          x-cloak
          x-show="view === 'list'"
          x-transition
        >
          @forelse ($products as $product)
            <x-common.product-card :$product :largeLayout="true" />
          @empty
            <h2 class="text-primary-400 text-3xl font-extrabold">No hay productos</h2>
          @endforelse
        </div>

        {{ $products->links('components.common.pagination.index') }}
      </div>
    </div>
  </div>

  @if (isset($details['description']))
    <div class="bg-primary-50 py-10">
      <div class="container space-y-4">
        <section class="special-content space-y-4 rounded-3xl bg-white p-4 md:p-10">
          {!! $details['description'] !!}
        </section>
      </div>
    </div>
  @endif
</main>
