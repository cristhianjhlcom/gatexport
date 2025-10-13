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
          {{ __('About Us') }}
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
              badge="{{ __('Required') }}"
              label="{{ __('History') }}"
              wire:model="about.{{ $locale }}.history"
            />

            <flux:editor
              badge="{{ __('Required') }}"
              label="{{ __('Mission') }}"
              wire:model="about.{{ $locale }}.mission"
            />

            <flux:editor
              badge="{{ __('Required') }}"
              label="{{ __('Vision') }}"
              wire:model="about.{{ $locale }}.vision"
            />

          </flux:tab.panel>
        @endforeach
      </flux:tab.group>
    </flux:card>

    <div>
      <flux:card class="space-y-4 divide-y divide-gray-200">
        <header class="space-y-2">
          <flux:heading level="2" size="lg">
            {{ __('About Us Image') }}
          </flux:heading>
          <flux:description size="xs">
            {{ __('Manage the about us images of your company.') }}
          </flux:description>
          <flux:separator />
        </header>

        <flux:field>
          <div class="flex items-center justify-start gap-x-4">
            <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
              @if (is_string($about['first_image']) || !method_exists($new_first_image, 'temporaryUrl'))
                <img
                  alt="Image Preview"
                  class="aspect-square h-auto w-[200px] object-contain"
                  src="{{ Storage::disk('public')->url($about['first_image']) }}"
                />
              @else
                <img
                  alt="Image Preview"
                  class="aspect-square h-auto w-[200px] object-contain"
                  src="{{ $new_first_image->temporaryUrl() }}"
                />
              @endif
            </div>

            <div class="space-y-4">
              <flux:label>{{ __('Imagen principal') }}</flux:label>
              <flux:description size="xs">
                Imagen principal entre 500x500px - 1000x1000px. Formatos: PNG, JPG, WEBP. Máximo: 2MB.
              </flux:description>
              <flux:input
                size="sm"
                type="file"
                wire:model="new_first_image"
              />
              <div wire:loading wire:target="new_first_image">
                <flux:icon.loading />
              </div>
              <flux:error name="new_first_image" />
            </div>
          </div>
        </flux:field>

        <flux:field>
          <div class="flex items-center justify-start gap-x-4">
            <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
              @if (is_string($about['second_image']) || !method_exists($new_second_image, 'temporaryUrl'))
                <img
                  alt="Image Preview"
                  class="aspect-square h-auto w-[200px] object-contain"
                  src="{{ Storage::disk('public')->url($about['second_image']) }}"
                />
              @else
                <img
                  alt="Image Preview"
                  class="aspect-square h-auto w-[200px] object-contain"
                  src="{{ $new_second_image->temporaryUrl() }}"
                />
              @endif
            </div>

            <div class="space-y-4">
              <flux:label>
                {{ __('Secondary Image') }}
              </flux:label>
              <flux:description size="xs">
                Imagen segundaria 500x500px - 1000x1000px. Formatos: PNG, JPG, WEBP. Máximo: 2MB.
              </flux:description>
              <flux:input
                size="sm"
                type="file"
                wire:model="new_second_image"
              />
              <div wire:loading wire:target="new_second_image">
                <flux:icon.loading />
              </div>
              <flux:error name="new_second_image" />
            </div>
          </div>
        </flux:field>

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

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
