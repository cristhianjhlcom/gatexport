<div class="space-y-4">
  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-2/4">

        {{-- Category Content --}}
        <flux:card class="space-y-4">
          <header class="flex items-center justify-between">
            <flux:heading>Crear Categoría</flux:heading>
          </header>
          <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <flux:input autocomplete="off" badge="Requerido" description:trailing="Versión en español del nombre" label="Nombre de la Categoría"
              placeholder="Lorem Ipsum" wire:model.blur="form.name.es" />

            <flux:input autocomplete="off" badge="Requerido" description:trailing="English version of the name" label="Category Name"
              placeholder="Lorem Ipsum" wire:model.blur="form.name.en" />
          </div>

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}/</flux:input.group.prefix>
              <flux:input disabled id="slug" placeholder="lorem-ipsum" readonly wire:model='form.slug' />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>

          <flux:input autocomplete="off" badge="Requerido" label="Color de fondo" placeholder="Ej: color en hexadecimal de la empresa..."
            size="sm" wire:model.blur="form.backgroundColor" />

          <div class="space-y-2 overflow-hidden">
            @php
              $image = $form->image ??= '';
              $hasImage = empty($image);
              $tmpImage = $form->image ??= null;
            @endphp

            <flux:file-upload label="Banner" size="sm" wire:model.live="form.image">
              <flux:file-upload.dropzone :heading="$image" inline text="1000x550 - JPG, PNG, Webp hasta 2MB" with-progress />
            </flux:file-upload>

            @if ($tmpImage && !is_string($tmpImage))
              <flux:file-item :heading="$tmpImage->getClientOriginalName()" :image="$tmpImage->temporaryUrl()" :size="$tmpImage->getSize()" />
            @endif
          </div>

          <div class="space-y-2 overflow-hidden">
            @php
              $whiteIcon = $form->whiteIcon ??= '';
              $hasWhiteIcon = empty($whiteIcon);
              $tmpWhiteIcon = $form->whiteIcon ??= null;
            @endphp

            <flux:file-upload label="Icono en color blanco" size="sm" wire:model.live="form.whiteIcon">
              <flux:file-upload.dropzone :heading="$whiteIcon" inline text="55x55 - JPG, PNG, Webp, SVG hasta 1MB" with-progress />
            </flux:file-upload>

            @if ($tmpWhiteIcon && !is_string($tmpWhiteIcon))
              <flux:file-item :heading="$tmpWhiteIcon->getClientOriginalName()" :image="$tmpWhiteIcon->temporaryUrl()"
                :size="$tmpWhiteIcon->getSize()" />
            @endif
          </div>

          <div class="space-y-2 overflow-hidden">
            @php
              $primaryIcon = $form->whiteIcon ??= '';
              $hasPrimaryIcon = empty($primaryIcon);
              $tmpPrimaryIcon = $form->primaryIcon ??= null;
            @endphp

            <flux:file-upload label="Icono en color primario" size="sm" wire:model.live="form.primaryIcon">
              <flux:file-upload.dropzone :heading="$primaryIcon" inline text="55x55 - JPG, PNG, Webp, SVG hasta 1MB" with-progress />
            </flux:file-upload>

            @if ($tmpPrimaryIcon && !is_string($tmpPrimaryIcon))
              <flux:file-item :heading="$tmpPrimaryIcon->getClientOriginalName()" :image="$tmpPrimaryIcon->temporaryUrl()"
                :size="$tmpPrimaryIcon->getSize()" />
            @endif
          </div>
        </flux:card>

        {{-- Category Submit Button --}}
        <div>
          <flux:button type="submit" variant="primary">
            Guardar
          </flux:button>

          <flux:button type="button" wire:click="createAnother">
            Guardar & Crear Otro
          </flux:button>
        </div>
      </div>
      <div class="w-full space-y-4 md:w-1/3"></div>
    </div>
  </form>
</div>
