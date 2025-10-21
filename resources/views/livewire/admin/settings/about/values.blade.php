<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Valores, Misión y Visión
    </flux:heading>
  </header>

  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <div class="space-y-4">
          <div>
            <flux:button
              icon:trailing="plus"
              size="sm"
              variant="outline"
              wire:click="addValue('{{ $locale }}')"
            >
              Agregar banner
            </flux:button>

            @if (isset($about[$locale]['values']['items']))
              <span class="text-sm text-gray-500">
                {{ count($about[$locale]['values']['items']) }} Valore(s) agregado(s)
              </span>
            @endif
          </div>

          @if (isset($about[$locale]['values']['items']))
            <div class="grid grid-cols-1 gap-4 space-y-4 md:grid-cols-2">
              @foreach ($about[$locale]['values']['items'] as $index => $value)
                <flux:card class="space-y-2">
                  <flux:input
                    badge="Requerido"
                    label="Icono"
                    wire:model="about.{{ $locale }}.values.items.{{ $index }}.icon"
                  />

                  <flux:editor
                    badge="Requerido"
                    label="Descripción"
                    wire:model="about.{{ $locale }}.values.items.{{ $index }}.description"
                  />

                  <div class="flex justify-end">
                    <flux:button
                      class="absolute right-0 top-0 z-10"
                      icon:trailing="x-mark"
                      size="sm"
                      variant="danger"
                      wire:click="removeValue({{ $index }})"
                      wire:confirm="Estas seguro de querer eliminar este elemento?"
                    />
                  </div>
                </flux:card>
              @endforeach
            </div>
          @else
            <div class="space-y-4">
              <flux:heading level="3" size="lg">
                Aun no hay valores cargados
              </flux:heading>
            </div>
          @endif
        </div>

        <flux:separator />

        <flux:input
          badge="Requerido"
          label="Misión Titulo"
          wire:model="about.{{ $locale }}.values.mission.title"
        />

        <flux:editor
          badge="Requerido"
          label="Misión Descripción"
          wire:model="about.{{ $locale }}.values.mission.description"
        />

        <flux:input
          badge="Requerido"
          label="Visión Titulo"
          wire:model="about.{{ $locale }}.values.vision.title"
        />

        <flux:editor
          badge="Requerido"
          label="Visión Descripción"
          wire:model="about.{{ $locale }}.values.vision.description"
        />
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
