<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Create Product') }}</flux:heading>
      <flux:text class="mt-2">{{ __('Change this product details') }}</flux:text>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
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
        {{-- @livewire('admin.categories.image-upload', ['form' => $form]) --}}
        <flux:card class="space-y-4">
          <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <flux:description>
              {{ __('Formats: PNG, JPG, WebP - Max dimensions: 1000x1000 (1:1) - Max size: 4.5 MB') }}
            </flux:description>
            {{-- <div class="dropzone w-full rounded border-2 border-dashed bg-gray-400" id="category-dropzone"></div> --}}
            <flux:input type="file" wire:model="form.image" />
            @if ($form->image)
              <img
                alt="Image Preview"
                class="h-10 w-10 rounded-lg object-contain"
                src="{{ $form->image->temporaryUrl() }}"
              />
            @endif
            <flux:error name="form.image" />
          </flux:field>
        </flux:card>

        {{-- Category Submit Button --}}
        <div>
          <flux:button type="submit" variant="primary">
            {{ __('Save') }}
          </flux:button>
        </div>
      </div>
      <div class="w-full space-y-4 md:w-1/3"></div>
    </div>
  </form>
</div>
