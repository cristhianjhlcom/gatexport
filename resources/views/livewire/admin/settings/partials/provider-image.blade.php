<flux:field>
  <div class="space-y-4">
    <flux:label>{{ __('Provider Logo') }}</flux:label>


    @if (!empty($provider['image']) && is_string($provider['image']))
      <img
        alt="Current Image"
        class="aspect-auto"
        src="{{ Storage::disk('public')->url($provider['image']) }}"
      />
    @endif

    <flux:description size="xs">
      Imagenes recomendadas: 500x500px. Formatos: JPG, PNG, WebP. Máximo: 2MB.
    </flux:description>

    <flux:input
      size="sm"
      type="file"
      wire:model="tmp_images.{{ $index }}.image"
    />

    <div wire:loading wire:target="providers.{{ $index }}.image">
      <flux:icon.loading />
    </div>

    @if (isset($tmp_images[$index]) && is_object($tmp_images[$index]) && method_exists($tmp_images[$index], 'temporaryUrl'))
      <small>Preview</small>
      <img
        alt="Image Preview"
        class="aspect-auto"
        src="{{ $tmp_images[$index]->temporaryUrl() }}"
      />
    @endif

    <flux:error name="tmp_images.{{ $index }}" />
    <flux:error name="providers.{{ $index }}.image" />
  </div>
</flux:field>
