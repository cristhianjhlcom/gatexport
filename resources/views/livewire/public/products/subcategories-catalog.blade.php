<main>
  @if (isset($subcategory->localizedBackgroundImage))
    <header>
      <img
        alt="{{ $subcategory->localizedName }}"
        class="aspect-auto h-80 w-full object-cover object-center"
        src="{{ Storage::disk('public')->url($subcategory->localizedBackgroundImage) }}"
      />
    </header>
  @endif

  <div class="container space-y-4 py-10">
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="w-full md:max-w-[250px]">
        <aside class="bg-primary-500 overflow-hidden rounded-sm border border-gray-200 text-white">
          <ul>
            @if ($subcategory)
              <li x-data="{ open: 'true' }">
                <button
                  @click="open = true"
                  class="hover:bg-primary-600 items-between flex w-full cursor-pointer items-center justify-between gap-4 p-4 font-extrabold"
                  type="button"
                >
                  <div class="flex items-center justify-start gap-2">
                    @if (isset($subcategory->icon_white))
                      <img
                        alt="Icono"
                        class="aspect-auto h-8 w-8 object-contain object-left"
                        src="{{ Storage::disk('public')->url($subcategory->icon_white) }}"
                      />
                    @endif
                    <span>{{ $subcategory->localizedName }}</span>
                  </div>
                </button>
              </li>
            @endif
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

  @if (isset($subcategory->description))
    <div class="bg-primary-50 py-10">
      <div class="container space-y-4">
        <section class="special-content space-y-4 rounded-3xl bg-white p-4 md:p-10">
          {!! $subcategory->localizedDescription !!}
        </section>
      </div>
    </div>
  @endif
</main>
