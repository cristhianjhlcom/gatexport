<form class="space-y-6" wire:submit.prevent="save">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Paises de Exportación
    </flux:heading>
  </header>
  <div>
    <div class="space-y-4">
      <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-3">
        @foreach ($continents as $continentIdx => $continent)
          <flux:card>
            <flux:checkbox.group class="space-y-4">
              <flux:checkbox.all :label="$continent['name']" />
              <flux:separator />
              @foreach ($continent['countries'] as $countryIdx => $country)
                <flux:checkbox :label="$country['name']"
                  wire:model="continents.{{ $continentIdx }}.countries.{{ $countryIdx }}.export"
                />
              @endforeach
            </flux:checkbox.group>
          </flux:card>
        @endforeach
      </div>
    </div>
  </div>

  <div class="fixed bottom-0 w-full border-gray-200 bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
