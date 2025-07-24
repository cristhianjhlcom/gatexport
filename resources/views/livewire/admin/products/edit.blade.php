<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Update Product') }}</flux:heading>
    </div>
    <div>
      <flux:button
        href="{{ route('products.show', [
            'category' => $form->product->subcategory->category,
            'subcategory' => $form->product->subcategory,
            'product' => $form->product,
        ]) }}"
      >
        {{ __('View this product') }}
      </flux:button>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-2/3">
        {{-- Product Content --}}
        <flux:card class="space-y-4">

          <flux:field>
            <flux:input
              autocomplete="off"
              id="name"
              placeholder="{{ __('Product') }}"
              type="text"
              wire:model.blur='form.name'
            />
            <flux:error name="form.name" />
          </flux:field>

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}</flux:input.group.prefix>
              <flux:input
                id="slug"
                placeholder="{{ __('product-slug') }}"
                readonly
                wire:model='form.slug'
              />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>

          <flux:editor
            badge="Optional"
            description:trailing="Short description about the product, must be at most 500 characters."
            label="{{ __('Description') }}"
            name="description"
            wire:model="form.description"
          />

        </flux:card>

        {{-- <livewire:shared.dropzone /> --}}
        <flux:card>
          <flux:field class="space-y-4">
            <flux:label>Imagenes del Producto</flux:label>

            @if (!empty($form->images))
              <flux:heading level="3" size="lg">
                Imagenes Actuales
              </flux:heading>
              <div class="mt-4 grid grid-cols-2 gap-x-2 md:grid-cols-4">
                @foreach ($form->images as $image)
                  @if (is_string($image) || !method_exists($image, 'temporaryUrl'))
                    <img
                      alt="Image Preview"
                      class="h-auto w-[200px] rounded-lg object-contain"
                      src="{{ Storage::disk('public')->url($image->path) }}"
                    />
                  @endif
                @endforeach
              </div>
            @endif

            <flux:description>
              Formatos Recomendados: PNG, JPG, WebP. Máximo: 1000x1000 (1:1). Máximo: 4.5 MB.
            </flux:description>

            <flux:input
              multiple
              type="file"
              wire:model="form.tmpImages"
            />

            @if (!empty($form->tmpImages))
              <flux:heading level="3" size="lg">
                Preview de las imágenes
              </flux:heading>
              <div class="mt-4 grid grid-cols-2 gap-x-2 md:grid-cols-4">
                @foreach ($form->tmpImages as $image)
                  @if (isset($image) && method_exists($image, 'temporaryUrl'))
                    <img
                      alt="Image Preview"
                      class="h-auto w-[200px] rounded-lg object-contain"
                      src="{{ $image->temporaryUrl() }}"
                    />
                  @endif
                @endforeach
              </div>
            @endif

            <div wire:loading wire:target="form.tmpImages">
              <flux:icon.loading />
            </div>

            <flux:error name="form.tmpImages.*" />
            <flux:error name="form.images.*" />

          </flux:field>
        </flux:card>

        {{-- Product Specifications --}}
        <livewire:admin.products.specifications :product="$form->product" />

        <div>
          <flux:button type="submit" variant="primary">
            {{ __('Save') }}
          </flux:button>
        </div>
      </div>
      <div class="w-full space-y-4 md:w-1/3">
        <flux:card class="space-y-4">
          <flux:heading>{{ __('Status') }}</flux:heading>
          <flux:select wire:model="form.status">
            @foreach ($status as $item)
              <flux:select.option value="{{ $item->value }}">
                {{ $item->label() }}
              </flux:select.option>
            @endforeach
          </flux:select>
        </flux:card>
        <flux:card class="space-y-4">
          <flux:select label="{{ __('Category') }}" wire:model.live="form.selectedCategoryId">
            @foreach ($categories as $item)
              <flux:select.option value="{{ $item->id }}">
                {{ $item->name }}
              </flux:select.option>
            @endforeach
          </flux:select>

          <flux:select label="{{ __('Subcategory') }}" wire:model.live="form.selectedSubcategoryId">
            <flux:select.option
              readonly
              value=""
              variant="ghost"
            >
              {{ __('Select Subcategory') }}
            </flux:select.option>
            @foreach ($form->subcategories as $item)
              <flux:select.option value="{{ $item->id }}">
                {{ $item->name }}
              </flux:select.option>
            @endforeach
          </flux:select>
        </flux:card>

        <flux:card class="space-y-4">
          <flux:field>
            <flux:label>{{ __('Seo Title') }}</flux:label>
            <flux:input
              autocomplete="off"
              id="seo_title"
              placeholder="{{ __('Pretty Title 📦') }}"
              type="text"
              wire:model.lazy="form.seo_title"
            />
            <flux:description>
              {{ __('Max characters 60 ') }}
            </flux:description>
            <flux:error name="form.seo_title" />
          </flux:field>
          <flux:field>
            <flux:label>{{ __('Seo Description') }}</flux:label>
            <flux:textarea
              autocomplete="off"
              id="seo_description"
              placeholder="{{ __('Descripción para los buscadores como Google, Bing, etc.') }}"
              rows="2"
              wire:model.lazy="form.seo_description"
            />
            <flux:description>
              {{ __('Max characters 160 ') }}
            </flux:description>
            <flux:error name="form.seo_description" />
          </flux:field>
        </flux:card>
      </div>
    </div>
  </form>
</div>
