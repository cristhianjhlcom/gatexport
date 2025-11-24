<flux:card class="space-y-2">
  <header>
    <flux:heading><strong>Beneficios</strong></flux:heading>
  </header>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      @php
        $benefits = $data[$locale]['benefits'] ??= [];
      @endphp
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <header class="rounded-sm border border-gray-200 p-4">
          <flux:button icon:trailing="plus" size="sm" variant="outline" wire:click="addBenefit('{{ $locale }}')">
            Agregar beneficio
          </flux:button>

          <span class="text-sm text-gray-500">
            {{ count($benefits) }} beneficios agregados
          </span>
        </header>

        @if (!empty($benefits))
          <flux:accordion class="rounded-sm border border-gray-200 p-4">
            @foreach ($benefits as $idx => $benefit)
              <flux:accordion.item :expanded="$loop->first">
                <flux:accordion.heading>
                  <strong>({{ $idx + 1 }})</strong>
                  @if (!empty($benefit['title']))
                    <strong>{{ $benefit['title'] }}</strong>
                  @else
                    <strong>Título Temporal</strong>
                  @endif
                </flux:accordion.heading>
                <flux:accordion.content>
                  <div class="space-y-4 pt-4">
                    <flux:input badge="Requerido" label="Título del beneficio" placeholder="Ej: En Gate Export..."
                      wire:model="data.{{ $locale }}.benefits.{{ $idx }}.title" />

                    <flux:textarea badge="Requerido" label="Título del beneficio" placeholder="Ej: construimos relaciones de confianza..."
                      rows="auto" wire:model="data.{{ $locale }}.benefits.{{ $idx }}.description" />

                    <flux:input badge="Requerido" label="Orden del beneficio" max="10" min="1" placeholder="Ej: 1" type="number"
                      wire:model="data.{{ $locale }}.benefits.{{ $idx }}.order" />

                    <div class="space-y-2 overflow-hidden">
                      @php
                        $image = $data[$locale]['benefits'][$idx]['image'] ??= '';
                        $hasImage = empty($image);
                        $tmpImage = $tmpImages[$locale]['benefits'][$idx]['image'] ??= null;
                      @endphp

                      <flux:file-upload label="Imagen ({{ $name }})" size="sm"
                        wire:model.live="tmpImages.{{ $locale }}.benefits.{{ $idx }}.image">
                        <flux:file-upload.dropzone :heading="$image" inline text="600x450 - JPG, PNG, Webp hasta 2MB" with-progress />
                      </flux:file-upload>

                      @if ($tmpImage)
                        <flux:file-item :heading="$tmpImage->getClientOriginalName()" :image="$tmpImage->temporaryUrl()"
                          :size="$tmpImage->getSize()" />
                      @endif
                    </div>

                    <div class="space-y-2 overflow-hidden">
                      @php
                        $background = $data[$locale]['benefits'][$idx]['background'] ??= '';
                        $hasImage = empty($background);
                        $tmpBackground = $tmpImages[$locale]['benefits'][$idx]['background'] ??= null;
                      @endphp

                      <flux:file-upload label="Fondo ({{ $name }})" size="sm"
                        wire:model.live="tmpImages.{{ $locale }}.benefits.{{ $idx }}.background">
                        <flux:file-upload.dropzone :heading="$background" inline text="900x350 - JPG, PNG, Webp hasta 2MB" with-progress />
                      </flux:file-upload>

                      @if ($tmpBackground)
                        <flux:file-item :heading="$tmpBackground->getClientOriginalName()" :image="$tmpBackground->temporaryUrl()"
                          :size="$tmpBackground->getSize()" />
                      @endif
                    </div>

                    <div>
                      <flux:button icon="trash" size="sm" variant="ghost"
                        wire:click="removeBenefit('{{ $locale }}', {{ $idx }})">Eliminar beneficio</flux:button>
                    </div>
                  </div>
                </flux:accordion.content>
              </flux:accordion.item>
            @endforeach
          </flux:accordion>
        @else
          <div class="w-full space-y-4">
            <flux:heading level="3" size="lg">
              No ha beneficios
            </flux:heading>
            <flux:description size="xs">
              Agrega un beneficio para empezar
            </flux:description>
          </div>
        @endif

        <footer class="rounded-sm border border-gray-200 p-4">
          <flux:button icon:trailing="plus" size="sm" variant="outline" wire:click="addBenefit('{{ $locale }}')">
            Agregar beneficio
          </flux:button>

          <span class="text-sm text-gray-500">
            {{ count($benefits) }} beneficios agregados
          </span>
        </footer>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
