@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      {{ __('Company Services') }}
    </flux:heading>
    <flux:description size="xs">
      {{ __('Manage the services offered by your company.') }}
    </flux:description>
  </header>

  {{-- Input of the main image --}}
  <flux:field>
    <div class="space-y-4">
      <flux:label>{{ __('Main Image') }}</flux:label>


      @if (!is_null($companyServices['main_image']) && is_string($companyServices['main_image']))
        <img
          alt="Current Image"
          class="aspect-auto"
          src="{{ Storage::disk('public')->url($companyServices['main_image']) }}"
        />
      @endif

      <flux:description size="xs">
        Imagene recomendada entre 500x500px - 1000x1000px. Formatos: JPG, PNG, WebP. Máximo: 2MB.
      </flux:description>

      <flux:input
        size="sm"
        type="file"
        wire:model="newMainImage"
      />

      <div wire:loading wire:target="newMainImage">
        <flux:icon.loading />
      </div>

      @if (isset($newMainImage) && method_exists($newMainImage, 'temporaryUrl'))
        <small>Preview</small>
        <img
          alt="Image Preview"
          class="aspect-auto"
          src="{{ $newMainImage->temporaryUrl() }}"
        />
      @endif

      <flux:error name="newMainImage" />
    </div>
  </flux:field>
  <flux:separator />
  {{-- #End Input of the main image --}}

  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <flux:button
          size="sm"
          variant="outline"
          wire:click="add('{{ $locale }}')"
        >
          {{ __('Add Service') }}
        </flux:button>

        <span class="text-sm text-gray-500">
          {{ count($companyServices[$locale]) }} {{ __('Services') }}
        </span>
        @if (!empty($companyServices[$locale]))
          <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($companyServices[$locale] as $index => $service)
              <flux:card class="space-y-4">
                <flux:input
                  badge="{{ __('Required') }}"
                  label="{{ __('Title') }}"
                  placeholder="Lorem Ipsum.."
                  wire:model="companyServices.{{ $locale }}.{{ $index }}.title"
                />

                <flux:editor
                  badge="{{ __('Required') }}"
                  label="{{ __('Description') }}"
                  wire:model="companyServices.{{ $locale }}.{{ $index }}.description"
                />

                <div class="flex justify-end">
                  <flux:button
                    class="absolute right-0 top-0 z-10"
                    icon:trailing="x-mark"
                    size="sm"
                    variant="danger"
                    wire:click="remove('{{ $locale }}', {{ $index }})"
                    wire:confirm="{{ __('Are you sure you want to delete this service?') }}"
                  >
                    Eliminar
                  </flux:button>
                </div>
              </flux:card>
            @endforeach
          </section>
        @else
          <flux:card class="max-w-4/12 space-y-4">
            <flux:heading level="3" size="lg">
              {{ __('No Services') }}
            </flux:heading>
            <flux:description size="xs">
              {{ __('Add a service to get started.') }}
            </flux:description>
          </flux:card>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
