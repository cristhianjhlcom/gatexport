<flux:card class="space-y-4">
  <div class="flex items-center justify-between gap-x-4">
    <div class="space-y-2">
      <flux:heading>Especificaciones ({{ count($specifications) }})</flux:heading>
      <flux:text>Agrega especificaciones del producto.</flux:text>
    </div>
    <div>
      <flux:modal.trigger name="add-specs">
        <flux:button :disabled="count($specifications) >= 5" icon:trailing="plus">
          Agregar especificación
        </flux:button>
      </flux:modal.trigger>

      <flux:modal class="md:w-[500px]" name="add-specs">
        <div class="space-y-4">
          <flux:input
            autocomplete="off"
            label="Clave"
            placeholder="Peso"
            type="text"
            wire:model="key"
          />

          <flux:input
            autocomplete="off"
            label="Valor"
            placeholder="10 KG"
            type="text"
            wire:model="value"
          />

          <div class="flex">
            <flux:spacer />
            <flux:button
              type="button"
              variant="primary"
              wire:click="add"
            >
              Crear especificación
            </flux:button>
          </div>
        </div>
      </flux:modal>

    </div>
  </div>

  <flux:table>
    <flux:table.columns>
      <flux:table.column>#</flux:table.column>
      <flux:table.column>Key</flux:table.column>
      <flux:table.column>Value</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
      @forelse ($specifications as $spec)
        <flux:table.row key="{{ $spec->id }}">
          <flux:table.cell>#{{ $spec->id }}</flux:table.cell>
          <flux:table.cell>{{ $spec['key'] }}</flux:table.cell>
          <flux:table.cell>{{ $spec['value'] }}</flux:table.cell>
          <flux:table.cell>
            <flux:button
              icon="x-mark"
              variant="subtle"
              wire:click="remove({{ $spec }})"
            />
          </flux:table.cell>
        </flux:table.row>
      @empty
        <flux:table.row>
          <flux:table.cell colspan="3">
            No se han agregado especificaciones.
          </flux:table.cell>
        </flux:table.row>
      @endforelse
    </flux:table.rows>
  </flux:table>

</flux:card>
