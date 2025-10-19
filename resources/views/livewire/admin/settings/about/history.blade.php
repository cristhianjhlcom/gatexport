<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Historia
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
          wire:model="about.{{ $locale }}.ourHistory.title"
        />

        <flux:editor
          badge="Requerido"
          label="Descripción"
          wire:model="about.{{ $locale }}.ourHistory.description"
        />

        <flux:file-upload label="Imagen Principal" wire:model="newHistoryMainImage">
          <flux:file-upload.dropzone
            inline
            text="500x500 - JPG, PNG, SVG hasta 2MB"
            with-progress
          />
        </flux:file-upload>

        @if (isset($about['history_main_image']))
          <div class="mt-4 flex flex-col gap-2">
            <flux:file-item
              heading="{{ Storage::disk('public')->url($about['history_main_image']) }}"
              image="{{ Storage::disk('public')->url($about['history_main_image']) }}"
              size="{{ Storage::disk('public')->size($about['history_main_image']) }}"
            />
          </div>
        @endif

        <flux:file-upload label="Background Image" wire:model="newHistoryBackgroundImage">
          <flux:file-upload.dropzone
            inline
            text="900x500 - JPG, PNG, SVG hasta 2MB"
            with-progress
          />
        </flux:file-upload>

        @if (isset($about['history_background_image']) &&
                !empty($about['history_background_image']) &&
                Storage::disk('public')->exists($about['history_background_image']))
          <div class="mt-4 flex flex-col gap-2">
            <flux:file-item
              heading="{{ Storage::disk('public')->url($about['history_background_image']) }}"
              image="{{ Storage::disk('public')->url($about['history_background_image']) }}"
              size="{{ Storage::disk('public')->size($about['history_background_image']) }}"
            />
          </div>
        @endif

      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
