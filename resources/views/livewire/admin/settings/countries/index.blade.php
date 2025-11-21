@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Países de Exportación
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
        <flux:button
          icon:trailing="plus"
          size="sm"
          variant="outline"
          wire:click="add('{{ $locale }}')"
        >
          Agregar continente
        </flux:button>

        <span class="text-sm text-gray-500">
          {{ count($continents[$locale]) }} Continente(s) agregado(s)
        </span>

        @if (!empty($this->continents[$locale]))
          <section class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($this->continents[$locale] as $idx => $continent)
              <flux:card class="space-y-4">
                <flux:textarea
                  badge="Requerido"
                  description="Sera utilizado como el alt de la imagen"
                  label="Título"
                  placeholder="Ej: Sahumerios, Inciensos y Velas"
                  wire:model="continents.{{ $locale }}.{{ $idx }}.title"
                />

                <flux:input
                  badge="Requerido"
                  label="Position del banner"
                  placeholder="Ej: 1"
                  type="number"
                  wire:model="continents.{{ $locale }}.{{ $idx }}.position"
                />

                <div class="space-y-4">
                  <div class="space-y-2 overflow-hidden">
                    @php
                      $image = $continent['image'] ??= '';
                      $hasImage = empty($image);
                      $tmp = $tmpImages[$locale][$idx] ??= null;
                    @endphp

                    <flux:file-upload
                      label="Imagen Desktop"
                      size="sm"
                      wire:model.live="tmpImages.{{ $locale }}.{{ $idx }}"
                    >
                      <flux:file-upload.dropzone
                        :heading="$image"
                        inline
                        text="1000x600 - JPG, PNG, Webp hasta 1MB"
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
                </div>

                <div class="flex justify-end">
                  <flux:button
                    icon:trailing="trash"
                    size="sm"
                    variant="ghost"
                    wire:click="remove('{{ $locale }}', {{ $idx }})"
                    wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir."
                  >
                    Eliminar
                  </flux:button>
                </div>
              </flux:card>
            @endforeach
          </section>
        @else
          <flux:card class="space-y-4">
            <flux:heading level="3" size="lg">
              Aun no hay continents cargados
            </flux:heading>
            <flux:description size="xs">
              Agrega un continente para comenzar
            </flux:description>
          </flux:card>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>

  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
