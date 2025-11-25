<section class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Crear artículo</flux:heading>
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
          <flux:input label="Título ({{ $name }})" placeholder="Título del artículo"
            wire:model.live.debounce.500ms="title.{{ $locale }}" />

          <flux:input label="URL ({{ $name }})" placeholder="titulo-del-articulo" wire:model="slug" />

          <flux:textarea label="Resumen ({{ $name }})" placeholder="Nos encargamos de..." wire:model="summary.{{ $locale }}" />

          <flux:editor label="Contenido ({{ $name }})" placeholder="Nos encargamos de gestionar..." row="10"
            wire:model="content.{{ $locale }}" />

          <div class="space-y-2 overflow-hidden">
            <flux:file-upload label="Imagen Principal" size="sm" wire:model.live="thumbnail">
              <flux:file-upload.dropzone :heading="$thumbnail" inline text="500x500 - JPG, PNG, Webp hasta 2MB" with-progress />
            </flux:file-upload>

            @if ($thumbnail)
              <flux:file-item :heading="$thumbnail->getClientOriginalName()" :image="$thumbnail->temporaryUrl()" :size="$thumbnail->getSize()" />
            @endif
          </div>

          <flux:checkbox :checked="$is_published" description="Hacer que esta política sea visible en el sitio público." label="Es público?"
            wire:model="is_published" />

          <flux:separator />

          {{-- SEO Section --}}
          <flux:input label="Título SEO ({{ $name }})" placeholder="Título SEO del artículo" wire:model="seo.title.{{ $locale }}" />

          <flux:textarea row="10" label="Descripción SEO ({{ $name }})" placeholder="Nos encargamos de..."
            wire:model="seo.description.{{ $locale }}" />

          <div class="space-y-2 overflow-hidden">
            <flux:file-upload label="Imagen SEO" size="sm" wire:model.live="seo.thumbnail">
              <flux:file-upload.dropzone :heading="$seo['thumbnail']" inline text="500x500 - JPG, PNG, Webp hasta 2MB" with-progress />
            </flux:file-upload>

            @if ($seo['thumbnail'])
              <flux:file-item :heading="$seo['thumbnail']->getClientOriginalName()" :image="$seo['thumbnail']->temporaryUrl()"
                :size="$seo['thumbnail']->getSize()" />
            @endif
          </div>

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
