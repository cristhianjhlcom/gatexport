<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Control de Calidad
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
        <flux:input badge="Requerido" label="Título" wire:model="about.{{ $locale }}.quality.title" />

        <flux:editor badge="Requerido" label="Descripción" wire:model="about.{{ $locale }}.quality.description" />

        <div class="space-y-2 overflow-hidden">
          @php
            $image = $about['quality_main_image'] ??= '';
            $hasImage = empty($image);
            $tmp = $newQualityMainImage ??= null;
          @endphp

          <flux:file-upload label="Imagen principal ({{ $name }})" size="sm" wire:model.live="newQualityMainImage">
            <flux:file-upload.dropzone :heading="$image" inline text="600x450 - JPG, PNG, SVG hasta 2MB" with-progress />
          </flux:file-upload>

          @if ($tmp)
            <flux:file-item :heading="$tmp->getClientOriginalName()" :image="$tmp->temporaryUrl()" :size="$tmp->getSize()" />
          @endif
        </div>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
