<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Update Sub Category') }}</flux:heading>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    @php
      $locales = ['es' => 'Español', 'en' => 'Ingles'];
    @endphp

    <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2">
      <flux:card class="space-y-4">
        <header>
          <flux:heading size="lg">Actualizar Subcategoría</flux:heading>
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
                autocomplete="off"
                badge="Requerido"
                label="Nombre ({{ $name }})"
                placeholder="Lorem Ipsum"
                size="sm"
                wire:model="form.name.{{ $locale }}"
              />

              <flux:editor
                label="Descripción ({{ $name }})"
                placeholder="Lorem ipsum..."
                size="sm"
                wire:model="form.description.{{ $locale }}"
              />

              <flux:input
                label="Posición"
                placeholder="Posición para ordenar"
                size="sm"
                wire:model="form.position"
              />

              <div class="space-y-2 overflow-hidden">
                <flux:file-upload
                  label="Background Image ({{ $name }})"
                  size="sm"
                  wire:model.live="form.tmpImages.backgroundImage.{{ $locale }}"
                >
                  <flux:file-upload.dropzone
                    :heading="$form->subcategory?->background_image[$locale] ?? ''"
                    inline
                    text="1000x550 - JPG, PNG, Webp hasta 2MB"
                    with-progress
                  />
                </flux:file-upload>
                @php
                  $tmpBackgroundImage = $form->tmpImages['backgroundImage'][$locale] ?? null;
                @endphp

                @if ($tmpBackgroundImage && !is_string($tmpBackgroundImage))
                  <flux:file-item
                    :heading="$tmpBackgroundImage->getClientOriginalName()"
                    :image="$tmpBackgroundImage->temporaryUrl()"
                    :size="$tmpBackgroundImage->getSize()"
                  />
                @endif
              </div>
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>

        <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
          <flux:field>
            <flux:label>Slug (Español)</flux:label>
            <flux:input.group>
              <flux:input.group.prefix>/</flux:input.group.prefix>
              <flux:input
                disabled
                id="slug"
                placeholder="lorem-ipsum"
                readonly
                size="sm"
                wire:model='form.slug'
              />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>

          <flux:field>
            <flux:label badge="Opcional">Slug (English)</flux:label>
            <flux:input.group>
              <flux:input.group.prefix>/</flux:input.group.prefix>
              <flux:input
                id="slug_en"
                placeholder="lorem-ipsum"
                size="sm"
                wire:model.blur='form.slug_en'
              />
            </flux:input.group>
            <flux:description>Leave empty to use Spanish slug</flux:description>
            <flux:error name="form.slug_en" />
          </flux:field>
        </div>

        <flux:input
          autocomplete="off"
          label="Color de fondo"
          placeholder="Ej: color en hexadecimal de la empresa..."
          size="sm"
          wire:model.blur="form.backgroundColor"
        />

        <div class="space-y-2 overflow-hidden">
          @php
            $whiteIcon = $form->subcategory->icon_white ?? '';
            $tmpWhiteIcon = $form->tmpImages['icon_white'] ?? null;
          @endphp

          <flux:file-upload
            label="Icono en color blanco"
            size="sm"
            wire:model.live="form.tmpImages.icon_white"
          >
            <flux:file-upload.dropzone
              :heading="$whiteIcon"
              inline
              text="55x55 - JPG, PNG, Webp, SVG hasta 1MB"
              with-progress
            />
          </flux:file-upload>

          @if ($tmpWhiteIcon && !is_string($tmpWhiteIcon))
            <flux:file-item
              :heading="$tmpWhiteIcon->getClientOriginalName()"
              :image="$tmpWhiteIcon->temporaryUrl()"
              :size="$tmpWhiteIcon->getSize()"
            />
          @endif
        </div>

        <div class="space-y-2 overflow-hidden">
          @php
            $primaryIcon = $form->subcategory->icon_primary ?? '';
            $tmpPrimaryIcon = $form->tmpImages['icon_primary'] ?? null;
          @endphp

          <flux:file-upload
            label="Icono en color primario"
            size="sm"
            wire:model.live="form.tmpImages.icon_primary"
          >
            <flux:file-upload.dropzone
              :heading="$primaryIcon"
              inline
              text="55x55 - JPG, PNG, Webp, SVG hasta 1MB"
              with-progress
            />
          </flux:file-upload>

          @if ($tmpPrimaryIcon && !is_string($tmpPrimaryIcon))
            <flux:file-item
              :heading="$tmpPrimaryIcon->getClientOriginalName()"
              :image="$tmpPrimaryIcon->temporaryUrl()"
              :size="$tmpPrimaryIcon->getSize()"
            />
          @endif
        </div>

        <div class="fixed bottom-0 w-full bg-white/75 py-2">
          <flux:button type="submit" variant="primary">Actualizar</flux:button>
          <flux:button type="button" wire:click="createAnother">Guardar & Crear Otro</flux:button>
        </div>
      </flux:card>

      <flux:card class="space-y-4">
        <header>
          <flux:heading size="lg">Información SEO</flux:heading>
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
                label="Título SEO ({{ $name }})"
                placeholder="Lorem Ipsum"
                size="sm"
                wire:model.blur="form.seo.title.{{ $locale }}"
              />

              <flux:textarea
                label="Descripción SEO ({{ $name }})"
                placeholder="Lorem ipsum..."
                size="sm"
                wire:model.blur="form.seo.description.{{ $locale }}"
              />
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>

        <div class="space-y-2 overflow-hidden">
          @php
            $seoImage = $form->tmpImages['seo_image'] ?? '';
            $tmpSeoImage = $form->tmpImages['seo_image'] ?? null;
          @endphp

          <flux:file-upload
            label="SEO Image"
            size="sm"
            wire:model.live="form.tmpImages.seo_image"
          >
            <flux:file-upload.dropzone
              :heading="$seoImage"
              inline
              text="500x500 - JPG, PNG, Webp hasta 2MB"
              with-progress
            />
          </flux:file-upload>

          @if ($tmpSeoImage && !is_string($tmpSeoImage))
            <flux:file-item
              :heading="$tmpSeoImage->getClientOriginalName()"
              :image="$tmpSeoImage->temporaryUrl()"
              :size="$tmpSeoImage->getSize()"
            />
          @endif
        </div>
      </flux:card>
    </div>
  </form>
</div>
