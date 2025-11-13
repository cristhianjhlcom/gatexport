@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-4" wire:submit.prevent="save">
  <header>
    <flux:heading size="lg">
      Información página de producto
    </flux:heading>
  </header>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <flux:card class="space-y-4">
      <header class="space-y-2">
        <flux:heading level="2" size="lg">
          Datos de página
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
              label="Título ({{ $name }})"
              placeholder="Título del producto..."
              wire:model="details.{{ $locale }}.title"
            />

            <flux:file-upload
              label="Imagen de fondo ({{ $name }})"
              size="sm"
              wire:model="tmp.{{ $locale }}.backgroundImage"
            >
              <flux:file-upload.dropzone
                inline
                text="Recomendado:1000x300 - JPG, PNG, Webp up to 1MB"
                with-progress
              />
            </flux:file-upload>

            @if (isset($details[$locale]['backgroundImage']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($details[$locale]['backgroundImage']) }}"
                  image="{{ Storage::disk('public')->url($details[$locale]['backgroundImage']) }}"
                  size="{{ Storage::disk('public')->size($details[$locale]['backgroundImage']) }}"
                />
              </div>
            @endif

            <flux:editor
              badge="Requerido"
              label="Descripción ({{ $name }})"
              placeholder="Descripción del producto..."
              wire:model="details.{{ $locale }}.description"
            />

            <flux:textarea
              label="Text Alternativo ({{ $name }})"
              placeholder="Lorem ipsum..."
              wire:model="details.{{ $locale }}.altText"
            />

            <flux:input
              label="Título Seo ({{ $name }})"
              placeholder="Título del producto..."
              wire:model="details.{{ $locale }}.seo.title"
            />

            <flux:textarea
              label="Descripción Seo ({{ $name }})"
              placeholder="Descripción del producto..."
              wire:model="details.{{ $locale }}.seo.description"
            />

            <flux:file-upload
              label="Imagen Seo ({{ $name }})"
              size="sm"
              wire:model="tmp.{{ $locale }}.seo.image"
            >
              <flux:file-upload.dropzone
                inline
                text="500x500 - JPG, PNG, Webp up to 1MB"
                with-progress
              />
            </flux:file-upload>

            @if (isset($details[$locale]['seo']['image']))
              <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                  heading="{{ Storage::disk('public')->url($details[$locale]['seo']['image']) }}"
                  image="{{ Storage::disk('public')->url($details[$locale]['seo']['image']) }}"
                  size="{{ Storage::disk('public')->size($details[$locale]['seo']['image']) }}"
                />
              </div>
            @endif
          </flux:tab.panel>
        @endforeach
      </flux:tab.group>
    </flux:card>
  </div>
  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
