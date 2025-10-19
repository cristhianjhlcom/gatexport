@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2">
    {{-- About us Page Settings --}}
    <div class="space-y-4">
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="2" size="lg">
            Página acerca de nosotros
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
    </div>
    {{-- #End About us Page Settings --}}

    {{-- Home page settings --}}
    <div>
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="2" size="lg">
            Página principal
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
                wire:model="about.{{ $locale }}.home.history"
              />
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>

        <flux:callout icon="exclamation-circle" variant="warning">
          <flux:callout.heading>Información importante</flux:callout.heading>
          <flux:callout.text>
            La imagen secundaria se ocultara en versiones móviles y tabletas.
          </flux:callout.text>
        </flux:callout>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <flux:file-upload label="Primera Imagen" wire:model="newHomeFirstImage">
              <flux:file-upload.dropzone inline text="300x450 - PNG, JPG, WEBP - Máx 2MB" />
            </flux:file-upload>
            @if (isset($about['home_first_image']) &&
                    !empty($about['home_first_image']) &&
                    Storage::disk('public')->exists($about['home_first_image']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($about['home_first_image']) }}"
                  image="{{ Storage::disk('public')->url($about['home_first_image']) }}"
                  size="{{ Storage::disk('public')->size($about['home_first_image']) }}"
                />
              </div>
            @endif
          </div>

          <div>
            <flux:file-upload label="Segunda Imagen" wire:model="newHomeSecondImage">
              <flux:file-upload.dropzone inline text="300x450 - PNG, JPG, WEBP - Máx 2MB" />
            </flux:file-upload>
            @if (isset($about['home_second_image']) &&
                    !empty($about['home_second_image']) &&
                    Storage::disk('public')->exists($about['home_second_image']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($about['home_second_image']) }}"
                  image="{{ Storage::disk('public')->url($about['home_second_image']) }}"
                  size="{{ Storage::disk('public')->size($about['home_second_image']) }}"
                />
              </div>
            @endif
          </div>
        </div>

        <flux:input
          description="Id del video sobre la historia de la empresa."
          label="YouTube Video ID"
          placeholder="guJLfqTFfIw"
          size="sm"
          wire:model="about.youtube_video_id"
        />
      </flux:card>
    </div>
    {{-- #End Home page settings --}}
  </div>

  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
