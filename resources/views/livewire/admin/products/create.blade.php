<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Create Product') }}</flux:heading>
    </div>
    <div></div>
  </div>

  <form
    class="space-y-4"
    enctype="multipart/form-data"
    wire:submit.prevent="save"
  >
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

        <flux:callout
          heading="Podras agregar imagenes y especificaciones luego de guardar el producto."
          icon="exclamation-triangle"
          variant="warning"
        />

        <div>
          <flux:button type="submit" variant="primary">
            Guardar & Continuar
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
