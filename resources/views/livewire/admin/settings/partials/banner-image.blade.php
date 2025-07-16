<flux:field>
  <div class="space-y-4">
    <flux:label>{{ __('Banner Image') }}</flux:label>


    @if (!empty($banner['image']) && is_string($banner['image']))
      <img
        alt="Current Image"
        class="aspect-auto"
        src="{{ Storage::disk('public')->url($banner['image']) }}"
      />
    @endif

    <flux:description size="xs">
      Imagenes recomendadas: 1200x600px. Formatos: JPG, PNG, WebP. Máximo: 2MB.
    </flux:description>

    <flux:input
      size="sm"
      type="file"
      wire:model="tmp_images.{{ $locale }}.{{ $index }}.image"
    />

    <div wire:loading wire:target="banners.{{ $locale }}.{{ $index }}.image">
      <flux:icon.loading />
    </div>

    @if (isset($tmp_images[$locale][$index]) && method_exists($tmp_images[$locale][$index], 'temporaryUrl'))
      <small>Preview</small>
      <img
        alt="Image Preview"
        class="aspect-auto"
        src="{{ $tmp_images[$locale][$index]->temporaryUrl() }}"
      />
    @endif

    <flux:error name="tmp_images.{{ $locale }}.{{ $index }}" />
    <flux:error name="banners.{{ $locale }}.{{ $index }}.image" />
  </div>
</flux:field>
