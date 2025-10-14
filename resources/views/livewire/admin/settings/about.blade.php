@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <flux:card class="space-y-4">
      <header class="space-y-2">
        <flux:heading level="2" size="lg">
          Acerca de nosotros
        </flux:heading>
        <flux:separator />
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
              wire:model="about.{{ $locale }}.history"
            />

            <flux:editor
              badge="Requerido"
              label="Misión"
              wire:model="about.{{ $locale }}.mission"
            />

            <flux:editor
              badge="Requerido"
              label="Visión"
              wire:model="about.{{ $locale }}.vision"
            />

          </flux:tab.panel>
        @endforeach
      </flux:tab.group>
    </flux:card>

    <div>
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="2" size="lg">
            Imagenes
          </flux:heading>
        </header>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <flux:file-upload label="Primera Imagen" wire:model="new_first_image">
              <flux:file-upload.dropzone inline text="300x450 - PNG, JPG, WEBP - Máx 2MB" />
            </flux:file-upload>
            @if (isset($about['first_image']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($about['first_image']) }}"
                  image="{{ Storage::disk('public')->url($about['first_image']) }}"
                  size="{{ Storage::disk('public')->size($about['first_image']) }}"
                />
              </div>
            @endif
          </div>

          <div>
            <flux:file-upload label="Segunda Imagen" wire:model="new_second_image">
              <flux:file-upload.dropzone inline text="300x450 - PNG, JPG, WEBP - Máx 2MB" />
            </flux:file-upload>
            @if (isset($about['second_image']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($about['second_image']) }}"
                  image="{{ Storage::disk('public')->url($about['second_image']) }}"
                  size="{{ Storage::disk('public')->size($about['second_image']) }}"
                />
              </div>
            @endif
          </div>
        </div>

        <flux:callout icon="exclamation-circle" variant="warning">
          <flux:callout.heading>Información importante</flux:callout.heading>
          <flux:callout.text>
            La imagen secundaria se ocultara en versiones móviles y tabletas.
          </flux:callout.text>
        </flux:callout>

        <flux:input
          description="Id del video sobre la historia de la empresa."
          label="YouTube Video ID"
          placeholder="guJLfqTFfIw"
          size="sm"
          wire:model="about.youtube_video_id"
        />
      </flux:card>
    </div>
  </div>

  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
