@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      {{ __('About Us') }}
    </flux:heading>
    <flux:description size="xs">
      {{ __('Manage the about us section of your company.') }}
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
        <flux:card class="max-w-6/12 w-full space-y-4">
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
        </flux:card>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
