<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Create Product') }}</flux:heading>
    </div>
  </div>

  <form
    class="space-y-4"
    enctype="multipart/form-data"
    wire:submit.prevent="save"
  >
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-2/4">

        {{-- Category Content --}}
        <flux:card class="space-y-4">
          <flux:field>
            <flux:input
              autocomplete="off"
              id="name"
              placeholder="{{ __('Product Name') }}"
              type="text"
              wire:model.blur='form.name'
            />
            <flux:error name="form.name" />
          </flux:field>
          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}/categories/</flux:input.group.prefix>
              <flux:input
                disabled
                id="slug"
                placeholder="{{ __('gold-ring') }}"
                readonly
                wire:model='form.slug'
              />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>
        </flux:card>

        {{-- Category Image Dropzone --}}
        <flux:card class="space-y-4">
          <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <flux:description>
              {{ __('Formats: PNG, JPG, WebP - Max dimensions: 1000x1000 (1:1) - Max size: 4.5 MB') }}
            </flux:description>
            <flux:input type="file" wire:model="form.image" />
            <div class="mt-4 grid grid-cols-2 gap-x-2 md:grid-cols-4">
              @if ($form->image)
                @if (is_string($form->image))
                  <img
                    alt="Image Preview"
                    class="h-auto w-[200px] rounded-lg object-contain"
                    src="{{ Storage::disk('public')->url($form->image) }}"
                  />
                @else
                  <img
                    alt="Image Preview"
                    class="h-auto w-[200px] rounded-lg object-contain"
                    src="{{ $form->image->temporaryUrl() }}"
                  />
                @endif
              @endif
            </div>
            <div wire:loading wire:target="form.image">
              <flux:icon.loading />
            </div>
            <flux:error name="form.image" />
          </flux:field>
        </flux:card>

        {{-- Category Submit Button --}}
        <div>
          <flux:button type="submit" variant="primary">
            @if ($form->category)
              {{ __('Update') }}
            @else
              {{ __('Save') }}
            @endif
          </flux:button>
        </div>
      </div>
      <div class="w-full space-y-4 md:w-1/3"></div>
    </div>
  </form>
</div>
