<form class="space-y-6" wire:submit.prevent="save">
  <section class="space-y-4">
    <header>
      <flux:heading level="2" size="lg">
        {{ __('Promotional Banners') }}
      </flux:heading>
      <flux:description size="xs">
        {{ __('Manage your promotional banners.') }}
      </flux:description>
    </header>
    <flux:separator />
    <flux:button
      size="sm"
      variant="outline"
      wire:click="add"
    >
      {{ __('Add Provider') }}
    </flux:button>
    <span class="text-sm text-gray-500">
      {{ count($providers) }} {{ __('Providers') }}
    </span>
    <section class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
      @foreach ($providers as $index => $provider)
        @include('livewire.admin.settings.partials.provider-card')
      @endforeach
    </section>
  </section>

  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
