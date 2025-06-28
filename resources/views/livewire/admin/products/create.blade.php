<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>{{ __('Create Product') }}</flux:heading>
      <flux:text class="mt-2">{{ __('Change this product details') }}</flux:text>
    </div>
    <div>
      <flux:button icon:trailing="arrow-top-right-on-square">
        {{ __('View this product') }}
      </flux:button>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-2/3">
        {{-- Product Content --}}
        <flux:card class="space-y-4">
          {{ $form->name }}
          <flux:field>
            <flux:input
              autocomplete="off"
              id="name"
              placeholder="{{ __('Product Name') }}"
              type="text"
              wire:model.live='form.name'
            />
            <flux:error name="form.name" />
          </flux:field>
          <flux:input.group>
            <flux:input.group.prefix>{{ env('APP_URL') }}/products/</flux:input.group.prefix>
            <flux:input
              id="slug"
              placeholder="{{ __('gold-ring') }}"
              readonly
              wire:model.defer='form.slug'
            />
          </flux:input.group>
          <flux:editor
            badge="Optional"
            description:trailing="Short description about the product, must be at most 500 characters."
            label="{{ __('Description') }}"
            name="description"
            wire:model="form.description"
          />
        </flux:card>

        <flux:card class="space-y-4">
          <flux:field>
            <flux:label>{{ __('Media') }}</flux:label>
            <flux:description>
              {{ __('Formats: PNG, JPG, WebP - Max dimensions: 1000x1000 (1:1) - Max size: 4.5 MB') }}
            </flux:description>
            <flux:input
              accept="image/*"
              multiple
              type="file"
              wire:model.lazy="form.images"
            />
            <flux:errorname="form.image" />
          </flux:field>

          @if ($form->images)
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
              @foreach ($form->images as $image)
                <div>
                  <img class="h-[100px] w-[100px] rounded-lg object-contain" src="{{ $image->temporaryUrl() }}">
                  <flux:button
                    icon="x-mark"
                    variant="subtle"class="absolute right-2 top-2"
                    wire:click="removeImage({{ $loop->index }})"
                  />
                </div>
              @endforeach
            </div>
          @endif
        </flux:card>

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
          <flux:input
            label="{{ __('Seo Title') }}"
            name="form.seo_title"
            placeholder="Pretty Title 📦"
            type="text"
            wire:model="form.seo_title"
          />
          <flux:textarea
            label="{{ __('Seo Description') }}"
            name="form.seo_description"
            placeholder="Descripción para los buscadores como Google, Bing, etc."
            rows="2"
            wire:model="form.seo_description"
          />
        </flux:card>
      </div>
    </div>
  </form>
</div>
