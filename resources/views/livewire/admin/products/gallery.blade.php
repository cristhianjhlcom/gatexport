<flux:card>
  <flux:field class="space-y-4">
    <flux:label>Imágenes</flux:label>

    @if (count($images) > 0)
      <div class="grid grid-cols-2 gap-x-2 md:grid-cols-4">
        @foreach ($images as $image)
          @if (is_string($image) || !method_exists($image, 'temporaryUrl'))
            <div class="relative">
              <img alt="Image Preview" class="aspect-square h-auto w-full rounded-sm object-contain"
                src="{{ Storage::disk('public')->url($image->path) }}" />
              <button
                class="absolute right-2 top-2 z-50 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 bg-white p-4 text-xs hover:bg-gray-300"
                type="button" wire:click="remove({{ $image }})">
                <flux:icon.trash class="size-4" />
              </button>
            </div>
          @endif
        @endforeach
      </div>
    @else
      <flux:callout heading="Agrega algunas imágenes a tu producto. Como máximo 4 imágenes." icon="exclamation-circle" variant="warning" />
    @endif

    <flux:separator />

    <div class="flex items-center gap-x-4">
      <div class="flex h-[200px] w-[200px] items-center justify-center overflow-hidden rounded-sm bg-gray-200">
        @if (isset($this->previewImage) && method_exists($this->previewImage, 'temporaryUrl'))
          <img alt="Image Preview" class="aspect-square h-auto w-[200px] rounded-sm object-contain" src="{{ $previewImage->temporaryUrl() }}" />
        @else
          <flux:heading level="3" variant="subtle">
            Preview
          </flux:heading>
        @endif
      </div>

      <div class="space-y-4">
        <flux:input type="file" wire:model="previewImage" />
        <flux:description>
          Formatos Recomendados: PNG, JPG, WebP. Máximo: 1000x1000 (1:1). Máximo: 4.5 MB.
        </flux:description>
        <flux:button icon:trailing="arrow-up-tray" wire:click="add">
          Guardar imagen
        </flux:button>

        <div wire:loading wire:target="previewImage">
          <flux:icon.loading />
        </div>

        <flux:error name="previewImage" />
      </div>

    </div>
  </flux:field>

</flux:card>
