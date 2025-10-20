<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Contacto
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
        <flux:input
          badge="Requerido"
          label="Título"
          wire:model="about.{{ $locale }}.contact.title"
        />

        <flux:editor
          badge="Requerido"
          label="Descripción"
          wire:model="about.{{ $locale }}.contact.description"
        />
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
