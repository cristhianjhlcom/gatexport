<flux:card class="space-y-2">
  <header>
    <flux:heading><strong>Mensaje Autoridad</strong></flux:heading>
  </header>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <flux:textarea badge="Requerido" label="Mensaje de autoridad ({{ $name }})" placeholder="Ej: Más de 10 años exportando..." rows="auto"
          wire:model="data.{{ $locale }}.authority.content" />
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
