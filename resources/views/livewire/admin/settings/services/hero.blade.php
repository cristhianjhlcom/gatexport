<flux:card class="space-y-2">
  <header>
    <flux:heading>Sección de Hero</flux:heading>
  </header>
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
          label="Título principal ({{ $name }})"
          placeholder="Ej: Nuestros Servicios"
          wire:model="data.{{ $locale }}.hero.title"
        />

        <flux:editor
          badge="Requerido"
          label="Descripción del servicio ({{ $name }})"
          placeholder="Ej: descripción de la sección"
          wire:model="data.{{ $locale }}.hero.description"
        />

        <div class="space-y-2 overflow-hidden">
          @php
            $image = $data[$locale]['hero']['image'] ??= '';
            $hasImage = empty($image);
            $tmp = $tmpImages[$locale]['hero'] ??= null;
          @endphp

          <flux:file-upload
            label="Imagen de fondo ({{ $name }})"
            size="sm"
            wire:model.live="tmpImages.{{ $locale }}.hero"
          >
            <flux:file-upload.dropzone
              :heading="$image"
              inline
              text="1000x330 - JPG, PNG, Webp hasta 2MB"
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
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
