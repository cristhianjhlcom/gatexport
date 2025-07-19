<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">{{ __('General Information') }}</flux:heading>
  </header>
  <section class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="space-y-6">
      <flux:card class="space-y-4">

        <flux:tab.group>
          <flux:tabs variant="segmented">
            <flux:tab name="es">Spanish</flux:tab>
            <flux:tab name="en">English</flux:tab>
          </flux:tabs>
          <flux:tab.panel name="es">
            <div class="space-y-4">
              <flux:input
                badge="{{ __('Required') }}"
                label="Nombre de la Empresa"
                placeholder="Gate Export"
                wire:model="general_info.es.company_name"
              />

              <flux:textarea
                badge="{{ __('Required') }}"
                label="Descripción Corta"
                placeholder="Lorem Ipsum..."
                wire:model="general_info.es.company_short_description"
              />

              <flux:editor
                badge="{{ __('Required') }}"
                label="Descripción Completa"
                placeholder="Lorem Ipsum..."
                wire:model="general_info.es.company_description"
              />
            </div>
          </flux:tab.panel>
          <flux:tab.panel name="en">
            <div class="space-y-4">
              <flux:input
                badge="{{ __('Required') }}"
                label="Company Name"
                placeholder="Gate Export"
                wire:model="general_info.en.company_name"
              />

              <flux:textarea
                badge="{{ __('Required') }}"
                label="Short Description"
                placeholder="Lorem Ipsum..."
                wire:model="general_info.en.company_short_description"
              />

              <flux:editor
                badge="{{ __('Required') }}"
                label="Full Description"
                placeholder="Lorem Ipsum..."
                wire:model="general_info.en.company_description"
              />
            </div>
          </flux:tab.panel>
        </flux:tab.group>

      </flux:card>
    </div>

    <div class="space-y-6">
      <flux:card class="space-y-4 divide-y divide-gray-200">

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

      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            {{ __('Social Media') }}
          </flux:heading>
          <flux:description size="xs">
            Enlaces a tus redes sociales.
          </flux:description>
          <flux:separator />
        </header>
        <flux:input
          description="URL de la cuenta de Facebook"
          label="Facebook"
          placeholder="https://www.facebook.com/gateexport"
          size="sm"
          wire:model="general_info.social_media.facebook"
        />

        <flux:input
          description="URL de la cuenta de YouTube"
          label="YouTube"
          placeholder="https://www.youtube.com/channel/"
          size="sm"
          wire:model="general_info.social_media.youtube"
        />

        <flux:input
          description="URL de la cuenta de LinkedIn"
          label="LinkedIn"
          placeholder="https://www.linkedin.com/company/gateexport"
          size="sm"
          wire:model="general_info.social_media.linkedin"
        />
      </flux:card>

      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            {{ __('Contact Information') }}
          </flux:heading>
          <flux:description size="xs">
            Información de contacto.
          </flux:description>
          <flux:separator />
        </header>
        <flux:input
          label="Dirección"
          placeholder="Calle Principal #123"
          size="sm"
          wire:model="general_info.contact_information.address"
        />

        <div class="grid grid-cols-2 gap-4">
          <flux:input
            label="Teléfono"
            placeholder="+52 (123) 456-7890"
            size="sm"
            wire:model="general_info.contact_information.phone"
          />

          <flux:input
            label="Teléfono secundario"
            placeholder="+52 (123) 456-7890"
            size="sm"
            wire:model="general_info.contact_information.second_phone"
          />
        </div>

        <flux:input
          label="Enlace WhatsApp"
          placeholder="https://wa.me/123456789"
          size="sm"
          wire:model="general_info.contact_information.whatsapp_link"
        />

        <flux:input
          label="Correo electrónico corporativo"
          placeholder="contacto@empresa.com"
          size="sm"
          wire:model="general_info.contact_information.email"
        />
      </flux:card>
    </div>
  </section>

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
