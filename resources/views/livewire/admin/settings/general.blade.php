<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">{{ __('General Information') }}</flux:heading>
  </header>
  <section class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <flux:card class="space-y-4">

      <flux:tab.group>
        <flux:tabs variant="segmented">
          <flux:tab name="es">Spanish</flux:tab>
          <flux:tab name="en">English</flux:tab>
        </flux:tabs>
        <flux:tab.panel name="es">
          <div class="space-y-4">
            <flux:input
              label="Nombre"
              placeholder="Gate Export"
              wire:model="general_info.es.company_name"
            />
            <flux:textarea
              label="Descripción Corta"
              placeholder="Lorem Ipsum..."
              wire:model="general_info.es.company_short_description"
            />
            <flux:editor
              label="Descripción Completa"
              placeholder="Lorem Ipsum..."
              wire:model="general_info.es.company_description"
            />
          </div>
        </flux:tab.panel>
        <flux:tab.panel name="en">
          <div class="space-y-4">
            <flux:input
              label="Company Name"
              placeholder="Gate Export"
              wire:model="general_info.en.company_name"
            />
            <flux:textarea
              label="Short Description"
              placeholder="Lorem Ipsum..."
              wire:model="general_info.en.company_short_description"
            />
            <flux:editor
              label="Full Description"
              placeholder="Lorem Ipsum..."
              wire:model="general_info.en.company_description"
            />
          </div>
        </flux:tab.panel>
      </flux:tab.group>

    </flux:card>

    <flux:card class="space-y-4 divide-y divide-gray-200">

      <flux:field>
        <div class="flex items-center justify-start gap-x-4">
          <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
            @if (is_string($settings['favicon']) || !method_exists($new_favicon, 'temporaryUrl'))
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ Storage::disk('public')->url($settings['favicon']) }}"
              />
            @else
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ $new_favicon->temporaryUrl() }}"
              />
            @endif
          </div>

          <div class="space-y-4">
            <flux:label>{{ __('Favicon') }}</flux:label>
            <flux:description size="xs">
              Recomendado: 32x32px o 64x64px. Formatos: ICO, PNG. Máximo: 512KB.
            </flux:description>
            <flux:input
              size="sm"
              type="file"
              wire:model="new_favicon"
            />
            <div wire:loading wire:target="new_favicon">
              <flux:icon.loading />
            </div>
            <flux:error name="new_favicon" />
          </div>
        </div>
      </flux:field>

      <flux:field>
        <div class="flex items-center justify-start gap-x-4">
          <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
            @if (is_string($settings['large_logo']) || !method_exists($new_large_logo, 'temporaryUrl'))
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ Storage::disk('public')->url($settings['large_logo']) }}"
              />
            @else
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ $new_large_logo->temporaryUrl() }}"
              />
            @endif
          </div>

          <div class="space-y-4">
            <flux:label>{{ __('Large Logo') }}</flux:label>
            <flux:description size="xs">
              Logo con texto. Recomendado: 400x100px. Formatos: PNG, JPG, SVG. Máximo: 2MB.
            </flux:description>
            <flux:input
              size="sm"
              type="file"
              wire:model="new_large_logo"
            />
            <div wire:loading wire:target="new_large_logo">
              <flux:icon.loading />
            </div>
            <flux:error name="new_large_logo" />
          </div>
        </div>
      </flux:field>

      <flux:field>
        <div class="flex items-center justify-start gap-x-4">
          <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
            @if (is_string($settings['small_logo']) || !method_exists($new_small_logo, 'temporaryUrl'))
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ Storage::disk('public')->url($settings['small_logo']) }}"
              />
            @else
              <img
                alt="Image Preview"
                class="object-contain"
                src="{{ $new_small_logo->temporaryUrl() }}"
              />
            @endif
          </div>

          <div class="space-y-4">
            <flux:label>{{ __('Small Logo') }}</flux:label>
            <flux:description size="xs">
              Solo ícono. Recomendado: 64x64px. Formatos: PNG, JPG, SVG. Máximo: 1MB.
            </flux:description>
            <flux:input
              size="sm"
              type="file"
              wire:model="new_small_logo"
            />
            <div wire:loading wire:target="new_small_logo">
              <flux:icon.loading />
            </div>
            <flux:error name="new_small_logo" />
          </div>
        </div>
      </flux:field>

    </flux:card>
  </section>

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
