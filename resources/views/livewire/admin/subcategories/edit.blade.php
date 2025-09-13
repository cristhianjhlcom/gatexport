<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Update Sub Category') }}</flux:heading>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-2/4">

        {{-- Category Content --}}
        <flux:card class="space-y-4">
          <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <flux:input
              autocomplete="off"
              badge="Requerido"
              description:trailing="Versión en español del nombre"
              label="Subcategoría"
              placeholder="Lorem Ipsum"
              wire:model.blur="form.name.es"
            />
            <flux:input
              autocomplete="off"
              badge="Requerido"
              description:trailing="English version of the name"
              label="Subcategory"
              placeholder="Lorem Ipsum"
              wire:model.blur="form.name.en"
            />
          </div>

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}/subcategories/</flux:input.group.prefix>
              <flux:input
                disabled
                id="slug"
                placeholder="lorem-ipsum"
                readonly
                wire:model='form.slug'
              />
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
        </flux:card>

        {{-- Category Image Dropzone --}}
        <flux:card class="flex items-center gap-x-4 space-y-4">
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

          <flux:field>
            <flux:label>Image</flux:label>

            <flux:input type="file" wire:model="form.image" />
            <flux:description>
              Formats: PNG, JPG, WebP - Dimensions: 1000x1000 (1:1) - Size: 4.5 MB
            </flux:description>

            <div wire:loading wire:target="form.image">
              <flux:icon.loading />
            </div>

            <flux:error name="form.image" />
          </flux:field>
        </flux:card>

        {{-- Category Submit Button --}}
        <div>
          <flux:button type="submit" variant="primary">
            {{ __('Update') }}
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
