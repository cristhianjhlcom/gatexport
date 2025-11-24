<div class="space-y-4">
  <flux:heading>Manejo de Ordenes</flux:heading>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      {{-- <flux:button href="{{ route('admin.orders.create') }}" icon="plus">
        {{ __('Add Order') }}
      </flux:button> --}}
    </div>

    <div class="overflow-x-auto">
      <flux:table :paginate="$orders">
        <flux:table.columns>
          <flux:table.column>Orden</flux:table.column>
          <flux:table.column>Cliente</flux:table.column>
          <flux:table.column>Estado</flux:table.column>
          <flux:table.column>Correo Electrónico</flux:table.column>
          <flux:table.column>Teléfono</flux:table.column>
          <flux:table.column>Encargado</flux:table.column>
          <flux:table.column>Fecha</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
          @foreach ($orders as $order)
            <flux:table.row key="{{ $order->id }}">
              <flux:table.cell class="font-bold">
                {{ $order->id }}
              </flux:table.cell>

              <flux:table.cell>
                {{ $order->customerFullName }}
              </flux:table.cell>

              <flux:table.cell>
                <flux:badge color="{{ $order->status->color() }}" size="sm">
                  {{ $order->status->label() }}
                </flux:badge>
              </flux:table.cell>

              <flux:table.cell class="font-bold">
                {{ $order->customer_email }}
              </flux:table.cell>

              <flux:table.cell>
                {{ $order->customer_phone }}
              </flux:table.cell>

              <flux:table.cell class="max-w-2xs text-wrap">
                {{ $order->manager->profile->fullName }}
              </flux:table.cell>

              <flux:table.cell class="max-w-2xs text-wrap">
                {{ $order->formattedCreatedAt }}
              </flux:table.cell>

              <flux:table.cell>
                <flux:dropdown align="end" position="bottom">
                  <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                  <flux:menu>
                    <flux:menu.item icon="pencil" type="button" wire:click="toggleStatus({{ $order }})">
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
  </div>
