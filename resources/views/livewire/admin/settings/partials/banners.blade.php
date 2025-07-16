<flux:card class="space-y-4">
  <header class="mb-4 flex items-center justify-between">
    <flux:heading level="2" size="lg">{{ __('Banners') }}</flux:heading>
  </header>

  <flux:tab.group>
    <flux:tabs variant="segmented">
      <flux:tab name="es">Spanish</flux:tab>
      <flux:tab name="en">English</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="es">
      <flux:button
        size="sm"
        variant="outline"
        wire:click="addBanner('es')"
      >
        {{ __('Add Banner') }}
      </flux:button>
      <div class="space-y-4">
        @if (isset($banners['es']))
          @foreach ($banners['es'] as $index => $banner)
            <div class="grid gap-4 sm:grid-cols-2">
              <flux:input
                label="Título"
                placeholder="Título del Banner"
                wire:model="banners.es.{{ $index }}.title"
              />
              <flux:input
                label="Descripción"
                placeholder="Descripción del Banner"
                wire:model="banners.es.{{ $index }}.short_description"
              />
              <flux:input
                label="Imagen del Banner"
                type="file"
                wire:model="banners.es.{{ $index }}.image"
              />
              <flux:input
                label="Texto del Enlace"
                placeholder="Comprar Ahora"
                wire:model="banners.es.{{ $index }}.link_text"
              />
              <flux:button
                class="sm:col-span-2"
                variant="danger"
                wire:click="removeBanner({{ $index }})"
              >
                Eliminar
              </flux:button>
            </div>
          @endforeach
        @endif
      </div>
    </flux:tab.panel>
    <flux:tab.panel name="en">
      <flux:button
        size="sm"
        variant="outline"
        wire:click="addBanner('en')"
      >
        {{ __('Add Banner') }}
      </flux:button>
      <div class="space-y-4">
        @if (isset($banners['en']))
          @foreach ($banners['en'] as $index => $banner)
            <div class="grid gap-4 sm:grid-cols-2">
              <flux:input
                label="Title"
                placeholder="Banner Title"
                wire:model="banners.en.{{ $index }}.title"
              />
              <flux:input
                label="Description"
                placeholder="Banner Description"
                wire:model="banners.en.{{ $index }}.short_description"
              />
              <flux:input
                label="Banner Image"
                type="file"
                wire:model="banners.en.{{ $index }}.image"
              />
              <flux:input
                label="Link Text"
                placeholder="Comprar Ahora"
                wire:model="banners.en.{{ $index }}.link_text"
              />
              <flux:button
                class="sm:col-span-2"
                variant="danger"
                wire:click="removeBanner({{ $index }})"
              >
                Remove
              </flux:button>
            </div>
          @endforeach
        @endif
      </div>
    </flux:tab.panel>
  </flux:tab.group>

</flux:card>
