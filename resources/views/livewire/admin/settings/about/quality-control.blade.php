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
        <flux:input
          badge="Requerido"
          label="Título"
          wire:model="about.{{ $locale }}.quality.title"
        />

        <flux:editor
          badge="Requerido"
          label="Descripción"
          wire:model="about.{{ $locale }}.quality.description"
        />

        <flux:file-upload label="Imagen Principal" wire:model="newQualityMainImage">
          <flux:file-upload.dropzone
            inline
            text="500x500 - JPG, PNG, SVG hasta 2MB"
            with-progress
          />
        </flux:file-upload>

        @if (isset($about['quality_main_image']))
          <div class="mt-4 flex flex-col gap-2">
            <flux:file-item
              heading="{{ Storage::disk('public')->url($about['quality_main_image']) }}"
              image="{{ Storage::disk('public')->url($about['quality_main_image']) }}"
              size="{{ Storage::disk('public')->size($about['quality_main_image']) }}"
            />
          </div>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
