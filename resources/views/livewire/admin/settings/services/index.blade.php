@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <flux:heading level="2" size="lg">
    Servicios de la Empresa
  </flux:heading>

  <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-2">
    <div class="space-y-4">
      @include('livewire.admin.settings.services.hero')
      @include('livewire.admin.settings.services.cycles')
      @include('livewire.admin.settings.services.lists')
      @include('livewire.admin.settings.services.authority')
      @include('livewire.admin.settings.services.benefits')
    </div>

    <div class="space-y-4">
      @include('livewire.admin.settings.services.home')
    </div>
  </div>

  @if ($errors->getMessages())
    <div class="max-w-xl divide-y divide-red-200 rounded-sm">
      @foreach ($errors->getMessages() as $field => $messages)
        <div class="bg-red-50 p-4">
          @foreach ($messages as $message)
            <div class="flex items-center gap-3">
              <span class="block h-2 w-2 rounded-full bg-red-500"></span>
              <p class="text-sm font-light text-red-500">{{ $message }}</p>
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
  @endif

  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>

    @if ($errors->getMessages())
      <small class="italic text-gray-500">Complete el formulario</small>
    @endif
  </div>
</form>
