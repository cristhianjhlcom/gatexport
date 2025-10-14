@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      Banners Promocionales
    </flux:heading>
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
          icon:trailing="plus"
          size="sm"
          variant="outline"
          wire:click="add('{{ $locale }}')"
        >
          Agregar banner
        </flux:button>
        <span class="text-sm text-gray-500">
          {{ count($banners[$locale]) }} Banner(s) agregado(s)
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
              Aun no hay banners cargados
            </flux:heading>
            <flux:description size="xs">
              Agrega un banner para comenzar
            </flux:description>
          </flux:card>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>


  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
