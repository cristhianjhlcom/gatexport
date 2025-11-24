<section>
  <header>
    <flux:heading level="1" size="lg">Políticas</flux:heading>
  </header>

  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel :key="$locale" class="space-y-4" name="{{ $locale }}">
        <form class="max-w-4xl space-y-6" wire:submit="save">
          <flux:input label="Título ({{ $name }})" placeholder="Política de privacidad"
            wire:model.live.debounce.500ms="title.{{ $locale }}" />

          <flux:input label="URL ({{ $name }})" placeholder="politica-privacidad" wire:model="slug" />

          <flux:editor label="Contenido ({{ $name }})" placeholder="Nos encargamos de gestionar..." row="100"
            wire:model="content.{{ $locale }}" />

          <flux:checkbox :checked="$is_published" description="Hacer que esta política sea visible en el sitio público." label="Es público?"
            wire:model="is_published" />

          <div class="flex items-center gap-4">
            <flux:button type="submit" variant="primary">Guardar</flux:button>

            @if ($errors->any())
              <span class="text-sm font-light italic text-zinc-400">
                Verifique todos los campos en ambos idiomas.
              </span>
            @endif
          </div>
        </form>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</section>
