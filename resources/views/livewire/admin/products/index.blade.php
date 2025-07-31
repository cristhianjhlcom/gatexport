<div class="space-y-4">
  <flux:heading>
    Manejo de Producto
  </flux:heading>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.products.create') }}" icon="plus">
        Agregar Producto
      </flux:button>
    </div>

    <flux:table :paginate="$products">
      <flux:table.columns>
        <flux:table.column>Nombre</flux:table.column>
        <flux:table.column>Estado</flux:table.column>
        <flux:table.column>Categoría</flux:table.column>
        <flux:table.column>Sub Categoría</flux:table.column>
        <flux:table.column>Fecha</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($products as $product)
          <flux:table.row key="{{ $product->id }}">
            <flux:table.cell>
              <div class="flex items-center gap-3 text-wrap">
                @if ($product->firstImage)
                  <img
                    alt="{{ $product->localizedName }}"
                    class="aspect-square h-10 w-10 rounded-sm object-contain"
                    src="{{ $product->firstImage }}"
                  />
                @else
                  <flux:avatar name="{{ $product->localizedName }}" />
                @endif
                {{ str()->words($product->localizedName, 3) }}
              </div>
            </flux:table.cell>
            <flux:table.cell>
              <flux:badge color="{{ $product->status->color() }}">
                {{ $product->status->label() }}
              </flux:badge>
            </flux:table.cell>
            <flux:table.cell>
              {{ $product->localizedCategoryName }}
            </flux:table.cell>
            <flux:table.cell>
              {{ $product->localizedSubcategoryName }}
            </flux:table.cell>
            <flux:table.cell>{{ $product->createdAtHuman() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item
                    href="{{ $product->showUrl }}"
                    icon:trailing="arrow-trending-up"
                    target="_blank"
                  >
                    Ver Producto
                  </flux:menu.item>
                  <flux:menu.item href="{{ route('admin.products.edit', $product) }}" icon:trailing="pencil">
                    Editar Producto
                  </flux:menu.item>
                  <flux:menu.item
                    icon:trailing="trash"
                    variant="danger"
                    wire:click="delete({{ $product }})"
                    wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir."
                  >
                    Eliminar Producto
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
