<form class="space-y-6" wire:submit.prevent="save">
  <flux:card class="space-y-4">
    <header>
      <flux:heading level="2" size="lg">
        {{ __('Promotional Banners') }}
      </flux:heading>
      <flux:description size="xs">
        {{ __('Manage your promotional banners.') }}
      </flux:description>
    </header>
    <section>
      Providers
    </section>
  </flux:card>

  <div>
    <flux:button type="submit" variant="primary">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</form>
