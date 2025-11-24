<flux:card class="space-y-4">
  <div class="flex items-center justify-between gap-x-4">
    <div class="space-y-2">
      <flux:heading>Especificaciones ({{ count($specifications) }})</flux:heading>
      <flux:text>Número máximo de especificaciones son 5</flux:text>
    </div>
    <div>
      <flux:modal.trigger name="add-specs">
        <flux:button :disabled="count($specifications) >= 5" icon:trailing="plus">
          Agregar especificación
        </flux:button>
      </flux:modal.trigger>

      <flux:modal class="md:w-[500px]" name="add-specs">
        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>
          @foreach ($locales as $locale => $name)
            <flux:tab.panel class="space-y-4" name="{{ $locale }}">
              <div class="space-y-4">
                <flux:input autocomplete="off" label="Clave ({{ $name }})" placeholder="Peso" type="text"
                  wire:model="values.{{ $locale }}.key" />

                <flux:input autocomplete="off" label="Valor ({{ $name }})" placeholder="10 KG" type="text"
                  wire:model="values.{{ $locale }}.value" />

                <div class="flex items-center gap-4">
                  <flux:button type="button" variant="primary" wire:click="add">
                    Crear especificación
                  </flux:button>

                  @error('values.*')
                    <small class="text-xs italic text-gray-400">Complete todos los idiomas</small>
                  @enderror
                </div>
              </div>
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>
      </flux:modal>

    </div>
  </div>

  <flux:table>
    <flux:table.columns>
      <flux:table.column>#</flux:table.column>
      @foreach ($locales as $locale => $name)
        <flux:table.column>Key ({{ $name }})</flux:table.column>
        <flux:table.column>Value ({{ $name }})</flux:table.column>
      @endforeach
    </flux:table.columns>

    <flux:table.rows>
      @forelse ($specifications as $spec)
        <flux:table.row key="{{ $spec->id }}">
          <flux:table.cell>#{{ $spec->id }}</flux:table.cell>
          @foreach ($locales as $locale => $name)
            <flux:table.cell>{{ $spec['value'][$locale]['key'] }}</flux:table.cell>
            <flux:table.cell>{{ $spec['value'][$locale]['value'] }}</flux:table.cell>
          @endforeach
          <flux:table.cell>
            <flux:button icon="x-mark" variant="subtle" wire:click="remove({{ $spec }})" />
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
