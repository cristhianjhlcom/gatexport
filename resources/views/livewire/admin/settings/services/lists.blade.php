<flux:card class="space-y-2">
  <header>
    <flux:heading><strong>Servicios de la Empresa</strong></flux:heading>
  </header>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      @php
        $services = $data[$locale]['services'] ??= [];
      @endphp
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <header class="rounded-sm border border-gray-200 p-4">
          <flux:button
            icon:trailing="plus"
            size="sm"
            variant="outline"
            wire:click="addService('{{ $locale }}')"
          >
            Agregar servicio
          </flux:button>

          <span class="text-sm text-gray-500">
            {{ count($services) }} servicios agregados
          </span>
        </header>

        @if (!empty($services))
          <flux:accordion class="rounded-sm border border-gray-200 p-4">
            @foreach ($services as $idx => $service)
              <flux:accordion.item :expanded="$loop->first">
                <flux:accordion.heading>
                  <strong>({{ $idx + 1 }})</strong>
                  @if (!empty($service['title']))
                    <strong>{{ $service['title'] }}</strong>
                  @else
                    <strong>Título Temporal</strong>
                  @endif
                </flux:accordion.heading>
                <flux:accordion.content>
                  <div class="space-y-4 pt-4">
                    <flux:input
                      badge="Requerido"
                      label="Título"
                      placeholder="Ej: Documentación aduanera..."
                      wire:model="data.{{ $locale }}.services.{{ $idx }}.title"
                    />

                    <flux:textarea
                      badge="Requerido"
                      label="Descripción"
                      placeholder="Ej: Brindamos asesoría en..."
                      rows="auto"
                      wire:model="data.{{ $locale }}.services.{{ $idx }}.description"
                    />

                    <flux:textarea
                      badge="Requerido"
                      label="Aviso"
                      placeholder="Ej: Servicio disponible para..."
                      rows="auto"
                      wire:model="data.{{ $locale }}.services.{{ $idx }}.disclaimer"
                    />

                    <flux:input
                      badge="Requerido"
                      label="Orden del servicio"
                      max="10"
                      min="1"
                      placeholder="Ej: 1"
                      type="number"
                      wire:model="data.{{ $locale }}.services.{{ $idx }}.order"
                    />

                    <div class="space-y-2 overflow-hidden">
                      @php
                        $image = $data[$locale]['services'][$idx]['image'] ??= '';
                        $hasImage = empty($image);
                        $tmp = $tmpImages[$locale]['services'][$idx] ??= null;
                      @endphp

                      <flux:file-upload
                        label="Icono ({{ $name }})"
                        size="sm"
                        wire:model.live="tmpImages.{{ $locale }}.services.{{ $idx }}"
                      >
                        <flux:file-upload.dropzone
                          :heading="$image"
                          inline
                          text="55x55 - JPG, PNG, Webp hasta 2MB"
                          with-progress
                        />
                      </flux:file-upload>

                      @if ($tmp)
                        <flux:file-item
                          :heading="$tmp->getClientOriginalName()"
                          :image="$tmp->temporaryUrl()"
                          :size="$tmp->getSize()"
                        />
                      @endif
                    </div>


                    <div>
                      <flux:button
                        icon="trash"
                        size="sm"
                        variant="ghost"
                        wire:click="removeService('{{ $locale }}', {{ $idx }})"
                      >Eliminar ciclo</flux:button>
                    </div>
                  </div>
                </flux:accordion.content>
              </flux:accordion.item>
            @endforeach
          </flux:accordion>
        @else
          <div class="w-full space-y-4">
            <flux:heading level="3" size="lg">
              No ha servicios
            </flux:heading>
            <flux:description size="xs">
              Agrega un servicio para empezar
            </flux:description>
          </div>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
