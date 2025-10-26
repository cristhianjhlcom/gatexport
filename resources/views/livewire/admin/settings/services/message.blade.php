<flux:card class="space-y-2">
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <h4>NEW SECTION (MESSAGE)</h4>
        {{-- <flux:input
          badge="Requerido"
          label="Título principal"
          placeholder="Ej: servicio principal"
          wire:model="data.{{ $locale }}.homepage.heading"
        /> --}}
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
