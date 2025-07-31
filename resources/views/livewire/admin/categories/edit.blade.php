<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>Actualizar Categoría</flux:heading>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-6/12">

        {{-- Category Content --}}
        <flux:card class="space-y-4">
          <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <flux:input
              autocomplete="off"
              badge="Requerido"
              description:trailing="Versión en español del nombre"
              label="Nombre de la Categoría"
              placeholder="Lorem Ipsum"
              wire:model.blur="form.name.es"
            />
            <flux:input
              autocomplete="off"
              badge="Requerido"
              description:trailing="English version of the name"
              label="Category Name"
              placeholder="Lorem Ipsum"
              wire:model.blur="form.name.en"
            />
          </div>

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}/categories/</flux:input.group.prefix>
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
        </flux:card>

        {{-- Category Image Dropzone --}}
        <flux:card class="flex items-center gap-x-4 space-y-4">
          <div>
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
          <flux:field>
            <flux:label>Imagen</flux:label>
            <flux:input type="file" wire:model="form.image" />

            <flux:description class="text-xs">
              Formatos: PNG, JPG, WebP - Dimensiones máximas: 1000x1000 (1:1) - Tamaño máximo: 4.5 MB
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
            Actualizar
          </flux:button>

          <flux:button type="button" wire:click="createAnother">
            Actualizar & Crear Otro
          </flux:button>
        </div>
      </div>
      <div class="w-full space-y-4 md:w-6/12"></div>
    </div>
  </form>
</div>
