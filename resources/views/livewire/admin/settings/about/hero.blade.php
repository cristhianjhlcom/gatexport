<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Banner Principal
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
        <flux:editor
          badge="Requerido"
          label="Historia"
          wire:model="about.{{ $locale }}.mainHistory"
        />

        <flux:file-upload label="Imagen del banner" wire:model="newHeroImage">
          <flux:file-upload.dropzone
            inline
            text="900x700 - JPG, PNG, SVG hasta 2MB"
            with-progress
          />
        </flux:file-upload>

      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
