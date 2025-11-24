<flux:card class="space-y-2">
  <header>
    <flux:heading><strong>Ciclos de Producción</strong></flux:heading>
  </header>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      @php
        $cycles = $data[$locale]['cycles'] ??= [];
      @endphp
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <header class="rounded-sm border border-gray-200 p-4">
          <flux:button icon:trailing="plus" size="sm" variant="outline" wire:click="addCycle('{{ $locale }}')">
            Agregar ciclo
          </flux:button>

          <span class="text-sm text-gray-500">
            {{ count($cycles) }} ciclos agregados
          </span>
        </header>

        @if (!empty($cycles))
          <flux:accordion class="rounded-sm border border-gray-200 p-4">
            @foreach ($cycles as $idx => $cycle)
              <flux:accordion.item :expanded="$loop->first">
                <flux:accordion.heading>
                  <strong>({{ $idx + 1 }})</strong>
                  @if (!empty($cycle['title']))
                    <strong>{{ $cycle['title'] }}</strong>
                  @else
                    <strong>Título Temporal</strong>
                  @endif
                </flux:accordion.heading>
                <flux:accordion.content>
                  <div class="space-y-4 pt-4">
                    <flux:textarea badge="Requerido" label="Encabezado del ciclo" placeholder="Ej: Ciclo de producción de Palo Santo..."
                      rows="auto" wire:model="data.{{ $locale }}.cycles.{{ $idx }}.title" />

                    <flux:input badge="Requerido" label="Orden del ciclo" max="10" min="1" placeholder="Ej: 1" type="number"
                      wire:model="data.{{ $locale }}.cycles.{{ $idx }}.order" />

                    <div class="space-y-2 overflow-hidden">
                      @php
                        $image = $data[$locale]['cycles'][$idx]['image'] ??= '';
                        $hasImage = empty($image);
                        $tmp = $tmpImages[$locale]['cycles'][$idx] ??= null;
                      @endphp

                      <flux:file-upload label="Imagen ({{ $name }})" size="sm"
                        wire:model.live="tmpImages.{{ $locale }}.cycles.{{ $idx }}">
                        <flux:file-upload.dropzone :heading="$image" inline text="1000x550 - JPG, PNG, Webp hasta 2MB" with-progress />
                      </flux:file-upload>

                      @if ($tmp)
                        <flux:file-item :heading="$tmp->getClientOriginalName()" :image="$tmp->temporaryUrl()" :size="$tmp->getSize()" />
                      @endif
                    </div>

                    <div>
                      <flux:button icon="trash" size="sm" variant="ghost"
                        wire:click="removeCycle('{{ $locale }}', {{ $idx }})">Eliminar ciclo</flux:button>
                    </div>
                  </div>
                </flux:accordion.content>
              </flux:accordion.item>
            @endforeach
          </flux:accordion>
        @else
          <div class="w-full space-y-4">
            <flux:heading level="3" size="lg">
              No ha ciclos
            </flux:heading>
            <flux:description size="xs">
              Agrega un ciclo para empezar
            </flux:description>
          </div>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
