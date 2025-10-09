<div class="space-y-4">
  <flux:field class="rounded-sm border border-zinc-200 p-4">
    <div class="space-y-4">
      <flux:label>Imagen del banner (Desktop)</flux:label>

      @if (!empty($banner['image_desktop']) && is_string($banner['image_desktop']))
        <img
          alt="Current Image"
          class="aspect-auto"
          src="{{ Storage::disk('public')->url($banner['image_desktop']) }}"
        />
      @endif

      <flux:description size="xs">
        Imagenes recomendadas: 1200x600px. Formatos: JPG, PNG, WebP. Máximo: 2MB.
      </flux:description>

      <flux:input
        size="sm"
        type="file"
        wire:model.live="tmp_images_desktop.{{ $locale }}.{{ $index }}"
      />

      <div wire:loading wire:target="tmp_images_desktop.{{ $locale }}.{{ $index }}">
        <flux:icon.loading />
      </div>

      @if (isset($tmp_images_desktop[$locale][$index]) &&
              is_object($tmp_images_desktop[$locale][$index]) &&
              method_exists($tmp_images_desktop[$locale][$index], 'temporaryUrl'))
        <small>Preview</small>
        <img
          alt="Image Preview"
          class="aspect-auto"
          src="{{ $tmp_images_desktop[$locale][$index]->temporaryUrl() }}"
        />
      @endif

      <flux:error name="tmp_images_desktop.{{ $locale }}.{{ $index }}" />
      <flux:error name="banners.{{ $locale }}.{{ $index }}.image_desktop" />
    </div>
  </flux:field>


  <flux:field class="overflow-hidden rounded-sm border border-zinc-200 p-4">
    <div class="flex items-start gap-4">
      <div class="w-[200px]">
        @if (!empty($banner['image_mobile']) && is_string($banner['image_mobile']))
          <img
            alt="Current Image"
            class="aspect-auto"
            src="{{ Storage::disk('public')->url($banner['image_mobile']) }}"
          />
        @endif

        @if (isset($tmp_images_mobile[$locale][$index]) &&
                is_object($tmp_images_mobile[$locale][$index]) &&
                method_exists($tmp_images_mobile[$locale][$index], 'temporaryUrl'))
          <small>Preview</small>
          <img
            alt="Image Preview"
            class="aspect-auto"
            src="{{ $tmp_images_mobile[$locale][$index]->temporaryUrl() }}"
          />
        @endif
      </div>
      <div class="flex-1 space-y-6">
        <flux:label>Imagen del banner (Mobile)</flux:label>
        <flux:description size="xs">
          500x500 - JPG, PNG, WebP - Máx. 2MB.
        </flux:description>

        <flux:input
          size="sm"
          type="file"
          wire:model.live="tmp_images_mobile.{{ $locale }}.{{ $index }}"
        />

        <div wire:loading wire:target="tmp_images_mobile.{{ $locale }}.{{ $index }}">
          <flux:icon.loading />
        </div>


        <flux:error name="tmp_images_mobile.{{ $locale }}.{{ $index }}" />
        <flux:error name="banners.{{ $locale }}.{{ $index }}.image_mobile" />
      </div>
    </div>
  </flux:field>
</div>
