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
        <flux:card class="space-y-4">
          <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <flux:description>
              {{ __('Formats: PNG, JPG, WebP - Max dimensions: 1000x1000 (1:1) - Max size: 4.5 MB') }}
            </flux:description>
            {{-- <div class="dropzone w-full rounded border-2 border-dashed bg-gray-400" id="category-dropzone"></div> --}}
            <flux:input
              multiple
              type="file"
              wire:model="form.images"
            />
            <div class="mt-4 grid grid-cols-2 gap-x-2 md:grid-cols-4">
              @if ($form->images)
                @foreach ($form->images as $image)
                  @if (is_string($image) || !method_exists($image, 'temporaryUrl'))
                    <img
                      alt="Image Preview"
                      class="h-auto w-[200px] rounded-lg object-contain"
                      src="{{ Storage::disk('public')->url($image->path ?? $image) }}"
                    />
                  @else
                    <img
                      alt="Image Preview"
                      class="h-auto w-[200px] rounded-lg object-contain"
                      src="{{ $image->temporaryUrl() }}"
                    />
                  @endif
                @endforeach
              @endif
            </div>
            <div wire:loading wire:target="form.images">
              <flux:icon.loading />
            </div>
            <flux:error name="form.images.*" />
          </flux:field>
        </flux:card>

        {{-- Product Specifications --}}
        <flux:card class="space-y-4">
          <div class="flex items-center justify-between gap-x-4">
            <div class="space-y-2">
              <flux:heading>{{ __('Specifications') }}</flux:heading>
              <flux:text>{{ __('Add specifications of the product.') }}</flux:text>
            </div>
            <div>
              <flux:modal.trigger name="add-specs">
                <flux:button icon:trailing="plus">
                  {{ __('Add Specification') }}
                </flux:button>
              </flux:modal.trigger>
              <flux:modal class="md:w-[500px]" name="add-specs">
                <div class="space-y-4">
                  <div>
                    <flux:heading size="lg">{{ __('Add New Specification') }}</flux:heading>
                    <flux:text class="mt-2">
                      {{ __('Fill the form below to add a new specification.') }}
                    </flux:text>
                  </div>
                  <flux:input
                    autocomplete="off"
                    id="specification-key"
                    placeholder="{{ __('Weight') }}"
                    type="text"
                    wire:model.lazy="form.specificationKey"
                  />
                  <flux:input
                    autocomplete="off"
                    id="specification-value"
                    placeholder="{{ __('10 KG') }}"
                    type="text"
                    wire:model.lazy="form.specificationValue"
                  />
                  <div class="flex">
                    <flux:spacer />
                    <flux:button
                      type="button"
                      variant="primary"
                      wire:click="addSpecification"
                    >
                      {{ __('Create Specification') }}
                    </flux:button>
                  </div>
                </div>
              </flux:modal>
            </div>
          </div>

          <flux:table>
            <flux:table.columns>
              <flux:table.column>#</flux:table.column>
              <flux:table.column>{{ __('Key') }}</flux:table.column>
              <flux:table.column>{{ __('Value') }}</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
              @forelse ($form->specifications as $spec)
                <flux:table.row key="{{ $spec['id'] }}">
                  <flux:table.cell>#{{ $spec['id'] }}</flux:table.cell>
                  <flux:table.cell>{{ $spec['key'] }}</flux:table.cell>
                  <flux:table.cell>{{ $spec['value'] }}</flux:table.cell>
                  <flux:table.cell>
                    <flux:button
                      icon="x-mark"
                      variant="subtle"
                      wire:click="removeSpecification({{ $spec['id'] }})"
                    />
                  </flux:table.cell>
                </flux:table.row>
              @empty
                <flux:table.row>
                  <flux:table.cell colspan="3">
                    {{ __('No specifications') }}
                  </flux:table.cell>
                </flux:table.row>
              @endforelse
            </flux:table.rows>
          </flux:table>
          @error('form.specifications')
            <small class="text-red-500">{{ $message }}</small>
          @enderror
          @for ($idx = 0; $idx < $form->specificationsCount; $idx++)
            @php($spec = $form->specifications[$idx])
            @error('form.specifications.' . $idx . '.key')
              <small class="text-red-500">{{ $message }}</small>
            @enderror
            @error('form.specifications.' . $idx . '.value')
              <small class="text-red-500">{{ $message }}</small>
            @enderror
          @endfor
        </flux:card>

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
