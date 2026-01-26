<div class="space-y-4">
  <header>
    <flux:heading size="lg">
      Manejo de Producto
    </flux:heading>
  </header>

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-end">
      <flux:button.group>
        <flux:button href="{{ route('admin.products.create') }}" icon:trailing="plus" size="sm">
          Agregar Producto
        </flux:button>
        <flux:button href="{{ route('admin.products.detail') }}" icon:trailing="wrench-screwdriver" size="sm">
          Configuración
        </flux:button>
      </flux:button.group>
    </div>

    <flux:table :paginate="$products">
      <flux:table.columns>
        <flux:table.column>Nombre</flux:table.column>
        <flux:table.column>Estado</flux:table.column>
        <flux:table.column>Posición</flux:table.column>
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
                  <img alt="{{ $product->localizedName }}" class="aspect-square h-10 w-10 rounded-sm object-contain"
                    src="{{ $product->firstImage }}" />
                @else
                  <flux:avatar name="{{ $product->localizedName }}" />
                @endif
                {{ $product->localizedName }}
              </div>
            </flux:table.cell>
            <flux:table.cell>
              <flux:badge color="{{ $product->status->color() }}">
                {{ $product->status->label() }}
              </flux:badge>
            </flux:table.cell>
            <flux:table.cell>
              {{ $product->position }}
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
                  <flux:menu.item href="{{ $product->showUrl }}" icon:trailing="arrow-trending-up" target="_blank">
                    Ver
                  </flux:menu.item>
                  <flux:menu.item href="{{ route('admin.products.edit', $product) }}" icon:trailing="pencil">
                    Editar
                  </flux:menu.item>
                  <flux:menu.item icon:trailing="trash" variant="danger" wire:click="delete({{ $product }})"
                    wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir.">
                    Eliminar
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
