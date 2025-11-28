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
      <flux:tab.panel
        :key="$locale"
        class="space-y-4"
        name="{{ $locale }}"
      >
        <form class="max-w-4xl space-y-6" wire:submit="save">
          <flux:field>
            <flux:label>Título ({{ $name }})</flux:label>
            <flux:input placeholder="Título del artículo" wire:model.live.debounce.500ms="title.{{ $locale }}" />
            <flux:description>
              Máximo caracteres <span x-text="$wire.title.{{ $locale }}.length"></span>/90
            </flux:description>
            <flux:error name="title.{{ $locale }}" />
          </flux:field>

          <flux:input
            label="URL ({{ $name }})"
            placeholder="titulo-del-articulo"
            wire:model="slug"
          />

          <flux:field>
            <flux:label>Resumen ({{ $name }})</flux:label>
            <flux:textarea
              placeholder="Nos encargamos de..."
              row="10"
              wire:model="summary.{{ $locale }}"
            />
            <flux:description>
              Máximo caracteres <span x-text="$wire.summary.{{ $locale }}.length"></span>/500
            </flux:description>
            <flux:error name="summary.{{ $locale }}" />
          </flux:field>

          <flux:field>
            <flux:label>Contenido ({{ $name }})</flux:label>
            <flux:editor
              placeholder="Nos encargamos de gestionar..."
              row="10"
              wire:model="content.{{ $locale }}"
            />
            <flux:description>
              Máximo caracteres <span x-text="$wire.content.{{ $locale }}.length"></span>/6000
            </flux:description>
            <flux:error name="content.{{ $locale }}" />
          </flux:field>

          <div class="space-y-2 overflow-hidden">
            <flux:file-upload
              label="Imagen Principal"
              size="sm"
              wire:model.live="thumbnail"
            >
              <flux:file-upload.dropzone
                :heading="$thumbnail"
                inline
                text="1050x780 - JPG, PNG, Webp hasta 2MB"
                with-progress
              />
            </flux:file-upload>

            @if ($thumbnail)
              <flux:file-item
                :heading="$thumbnail->getClientOriginalName()"
                :image="$thumbnail->temporaryUrl()"
                :size="$thumbnail->getSize()"
              />
            @endif
          </div>

          <flux:checkbox
            :checked="$is_published"
            description="Hacer que esta política sea visible en el sitio público."
            label="Es público?"
            wire:model="is_published"
          />

          <flux:separator />

          {{-- SEO Section --}}
          <flux:field>
            <flux:label>Título SEO ({{ $name }})</flux:label>
            <flux:input placeholder="Título SEO del artículo" wire:model="seo.title.{{ $locale }}" />
            <flux:description>
              Máximo caracteres <span x-text="$wire.seo.title.{{ $locale }}.length"></span>/60
            </flux:description>
            <flux:error name="seo.title.{{ $locale }}" />
          </flux:field>

          <flux:field>
            <flux:label>Descripción SEO ({{ $name }})</flux:label>
            <flux:textarea
              placeholder="Nos encargamos de..."
              row="10"
              wire:model="seo.description.{{ $locale }}"
            />
            <flux:description>
              Máximo caracteres <span x-text="$wire.seo.description.{{ $locale }}.length"></span>/160
            </flux:description>
            <flux:error name="seo.description.{{ $locale }}" />
          </flux:field>

          <div class="space-y-2 overflow-hidden">
            <flux:file-upload
              label="Imagen SEO"
              size="sm"
              wire:model.live="seo.thumbnail"
            >
              <flux:file-upload.dropzone
                :heading="$seo['thumbnail']"
                inline
                text="1050x780 - JPG, PNG, Webp hasta 2MB"
                with-progress
              />
            </flux:file-upload>

            @if ($seo['thumbnail'])
              <flux:file-item
                :heading="$seo['thumbnail']->getClientOriginalName()"
                :image="$seo['thumbnail']->temporaryUrl()"
                :size="$seo['thumbnail']->getSize()"
              />
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
