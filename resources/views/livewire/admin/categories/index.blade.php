<div class="space-y-4">
  <flux:heading>Administración de Categorías</flux:heading>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.categories.create') }}" icon="plus">
        Agregar Categoría
      </flux:button>
    </div>

    <flux:table :paginate="$categories">
      <flux:table.columns>
        <flux:table.column>Nombre</flux:table.column>
        <flux:table.column>Fecha</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($categories as $category)
          <flux:table.row key="{{ $category->id }}">
            <flux:table.cell class="flex items-center gap-3 text-wrap">
              @if ($category->iconPrimaryUrl)
                <img
                  alt="{{ $category->localizedName }}"
                  class="h-10 w-10 rounded-lg object-contain"
                  src="{{ $category->iconPrimaryUrl }}"
                />
              @else
                <flux:avatar name="{{ $category->localizedName }}" />
              @endif
              {{ $category->localizedName }}
            </flux:table.cell>
            <flux:table.cell>{{ $category->formattedCreatedAt() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item href="{{ route('admin.categories.edit', $category) }}" icon="pencil">
                    Editar
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
