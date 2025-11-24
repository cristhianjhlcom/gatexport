<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Certificaciones
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
        <flux:input badge="Requerido" label="Título" wire:model="about.{{ $locale }}.certification.title" />

        <flux:editor badge="Requerido" label="Descripción" wire:model="about.{{ $locale }}.certification.description" />

        <flux:file-upload label="Imagen Principal" wire:model="newCertificationMainImage">
          <flux:file-upload.dropzone inline text="300x500 - JPG, PNG, SVG hasta 2MB" with-progress />
        </flux:file-upload>

        @if (isset($about['certification_main_image']))
          <div class="mt-4 flex flex-col gap-2">
            <flux:file-item heading="{{ Storage::disk('public')->url($about['certification_main_image']) }}"
              image="{{ Storage::disk('public')->url($about['certification_main_image']) }}"
              size="{{ Storage::disk('public')->size($about['certification_main_image']) }}" />
          </div>
        @endif

        <flux:file-upload label="Imagen Secundaria" wire:model="newCertificationSecondaryImage">
          <flux:file-upload.dropzone inline text="300x500 - JPG, PNG, SVG hasta 2MB" with-progress />
        </flux:file-upload>

        @if (isset($about['certification_secondary_image']))
          <div class="mt-4 flex flex-col gap-2">
            <flux:file-item heading="{{ Storage::disk('public')->url($about['certification_secondary_image']) }}"
              image="{{ Storage::disk('public')->url($about['certification_secondary_image']) }}"
              size="{{ Storage::disk('public')->size($about['certification_secondary_image']) }}" />
          </div>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
