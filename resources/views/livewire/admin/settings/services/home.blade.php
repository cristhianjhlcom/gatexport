<flux:card class="space-y-2">
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <flux:input
          badge="Requerido"
          label="Título principal"
          placeholder="Ej: servicio principal"
          wire:model="data.{{ $locale }}.homepage.heading"
        />

        <flux:editor
          badge="Requerido"
          label="Descripción del servicio"
          placeholder="Ej: descripción de la sección"
          wire:model="data.{{ $locale }}.homepage.description"
        />

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <flux:textarea
            badge="Requerido"
            label="Mensaje importante"
            placeholder="Ej: lorem ipsum"
            wire:model="data.{{ $locale }}.homepage.importantMessage"
          />

          <flux:textarea
            badge="Requerido"
            label="Observación"
            placeholder="Ej: lorem ipsum"
            wire:model="data.{{ $locale }}.homepage.disclaimer"
          />
        </div>

        <div class="overflow-hidden">
          @php
            $image = $data[$locale]['homepage']['image'] ??= '';
            $hasImage = empty($image);
            $tmp = $tmpImages[$locale]['homepage'] ??= null;
          @endphp

          <flux:file-upload
            label="Imagen Principal"
            size="sm"
            wire:model.live="tmpImages.{{ $locale }}.homepage"
          >
            <flux:file-upload.dropzone
              :heading="$image"
              inline
              text="600x1000 - JPG, PNG, Webp hasta 2MB"
              with-progress
            />
          </flux:file-upload>

          @if ($tmp)
            <flux:file-item
              :heading="$tmp->getClientOriginalName()"
              :image="$tmp->temporaryUrl()"
              :size="$tmp->getSize()"
              {{-- :heading="Storage::disk('public')->url($image)"
                :image="Storage::disk('public')->url($image)"
                :size="Storage::disk('public')->size($image)" --}}
            />
          @endif
        </div>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
