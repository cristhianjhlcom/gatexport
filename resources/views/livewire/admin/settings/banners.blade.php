@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      {{ __('Promotional Banners') }}
    </flux:heading>
    <flux:description size="xs">
      {{ __('Manage your promotional banners.') }}
    </flux:description>
  </header>

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
          {{ __('Add Banner') }}
        </flux:button>
        <span class="text-sm text-gray-500">
          {{ count($banners[$locale]) }} {{ __('Banners') }}
        </span>
        @if (!empty($banners[$locale]))
          <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($banners[$locale] as $index => $banner)
              @include('livewire.admin.settings.partials.banner-card')
            @endforeach
          </section>
        @else
          <flux:card class="space-y-4">
            <flux:heading level="3" size="lg">
              {{ __('No Banners') }}
            </flux:heading>
            <flux:description size="xs">
              {{ __('Add a banner to get started.') }}
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
