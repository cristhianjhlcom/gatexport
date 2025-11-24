<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>Crear Sub categoría</flux:heading>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    @php
      $locales = ['es' => 'Español', 'en' => 'Ingles'];
    @endphp

    <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2">
      <flux:card class="space-y-4">
        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>

          @foreach ($locales as $locale => $name)
            <flux:tab.panel class="space-y-4" name="{{ $locale }}">
              <flux:input autocomplete="off" badge="Requerido" label="Nombre ({{ $name }})" placeholder="Lorem Ipsum" size="sm"
                wire:model="form.name.{{ $locale }}" />

              <flux:editor label="Descripción ({{ $name }})" placeholder="Lorem ipsum..." size="sm"
                wire:model="form.description.{{ $locale }}" />

              <div class="space-y-2 overflow-hidden">
                <flux:file-upload label="Background Image ({{ $name }})" size="sm"
                  wire:model.live="form.backgroundImage.{{ $locale }}">
                  <flux:file-upload.dropzone inline text="1000x550 - JPG, PNG, Webp hasta 2MB" with-progress />
                </flux:file-upload>
              </div>
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>

        <flux:field>
          <flux:input.group>
            <flux:input.group.prefix>{{ env('APP_URL') }}/subcategories/</flux:input.group.prefix>
            <flux:input disabled id="slug" placeholder="lorem-ipsum" readonly size="sm" wire:model='form.slug' />
          </flux:input.group>
          <flux:error name="form.slug" />
        </flux:field>

        <flux:field>
          <flux:label>Categoría</flux:label>
          <flux:select wire:model="form.category_id">
            <flux:select.option value="">Choose Category</flux:select.option>
            @foreach ($categories as $category)
              <flux:select.option value="{{ $category->id }}">
                {{ $category->localizedName }}
              </flux:select.option>
            @endforeach
          </flux:select>
          <flux:error name="form.category_id" />
        </flux:field>

        <flux:input autocomplete="off" label="Color de fondo" placeholder="Ej: color en hexadecimal de la empresa..." size="sm"
          wire:model.blur="form.backgroundColor" />

        <div class="space-y-2 overflow-hidden">
          @php
            $whiteIcon = $form->tmpImages['icon_white'] ?? '';
            $tmpWhiteIcon = $form->tmpImages['icon_white'] ?? null;
          @endphp

          <flux:file-upload label="Icono en color blanco" size="sm" wire:model.live="form.tmpImages.icon_white">
            <flux:file-upload.dropzone :heading="$whiteIcon" inline text="55x55 - JPG, PNG, Webp, SVG hasta 1MB" with-progress />
          </flux:file-upload>

          @if ($tmpWhiteIcon && !is_string($tmpWhiteIcon))
            <flux:file-item :heading="$tmpWhiteIcon->getClientOriginalName()" :image="$tmpWhiteIcon->temporaryUrl()"
              :size="$tmpWhiteIcon->getSize()" />
          @endif
        </div>

        <div class="space-y-2 overflow-hidden">
          @php
            $primaryIcon = $form->tmpImages['icon_primary'] ?? '';
            $tmpPrimaryIcon = $form->tmpImages['icon_primary'] ?? null;
          @endphp

          <flux:file-upload label="Icono en color primario" size="sm" wire:model.live="form.tmpImages.icon_primary">
            <flux:file-upload.dropzone :heading="$primaryIcon" inline text="55x55 - JPG, PNG, Webp, SVG hasta 1MB" with-progress />
          </flux:file-upload>

          @if ($tmpPrimaryIcon && !is_string($tmpPrimaryIcon))
            <flux:file-item :heading="$tmpPrimaryIcon->getClientOriginalName()" :image="$tmpPrimaryIcon->temporaryUrl()"
              :size="$tmpPrimaryIcon->getSize()" />
          @endif
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
              <flux:input label="Título SEO ({{ $name }})" placeholder="Lorem Ipsum" size="sm"
                wire:model.blur="form.seo.title.{{ $locale }}" />

              <flux:textarea label="Descripción SEO ({{ $name }})" placeholder="Lorem ipsum..." size="sm"
                wire:model.blur="form.seo.description.{{ $locale }}" />
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>

        <div class="space-y-2 overflow-hidden">
          @php
            $seoImage = $form->tmpImages['seo_image'] ?? '';
            $tmpSeoImage = $form->tmpImages['seo_image'] ?? null;
          @endphp

          <flux:file-upload label="SEO Image" size="sm" wire:model.live="form.tmpImages.seo_image">
            <flux:file-upload.dropzone :heading="$seoImage" inline text="500x500 - JPG, PNG, Webp hasta 2MB" with-progress />
          </flux:file-upload>

          @if ($tmpSeoImage && !is_string($tmpSeoImage))
            <flux:file-item :heading="$tmpSeoImage->getClientOriginalName()" :image="$tmpSeoImage->temporaryUrl()"
              :size="$tmpSeoImage->getSize()" />
          @endif
        </div>
      </flux:card>

      <div class="fixed bottom-0 w-full bg-white/75 py-2">
        <flux:button type="submit" variant="primary">Crear</flux:button>
        <flux:button type="button" wire:click="createAnother">Guardar & Crear Otro</flux:button>
      </div>
    </div>
  </form>
</div>
