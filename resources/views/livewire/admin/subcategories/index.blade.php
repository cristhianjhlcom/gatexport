<div class="space-y-4">
  <flux:heading>Manejo de Sub-categorías</flux:heading>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.subcategories.create') }}" icon="plus">
        Agregar Sub-categoría
      </flux:button>
    </div>

    <flux:table :paginate="$subcategories">
      <flux:table.columns>
        <flux:table.column>Nombre</flux:table.column>
        <flux:table.column>Categoría</flux:table.column>
        <flux:table.column>Posición</flux:table.column>
        <flux:table.column>Fecha</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($subcategories as $subcategory)
          <flux:table.row key="{{ $subcategory->id }}">
            <flux:table.cell class="flex items-center gap-3 text-wrap">
              @if ($subcategory->iconPrimaryUrl)
                <img alt="{{ $subcategory->localizedName }}" class="h-10 w-10 rounded-lg object-contain" src="{{ $subcategory->iconPrimaryUrl }}" />
              @else
                <flux:avatar name="{{ $subcategory->localizedName }}" />
              @endif
              {{ $subcategory->localizedName }}
            </flux:table.cell>
            <flux:table.cell>
              {{ $subcategory->category->localizedName }}
            </flux:table.cell>
            <flux:table.cell>{{ $subcategory->position }}</flux:table.cell>
            <flux:table.cell>{{ $subcategory->formattedCreatedAt() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item href="{{ route('admin.subcategories.edit', $subcategory) }}" icon="pencil">
                    Actualizar
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
