<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div>
      <flux:heading>Actualizar Producto</flux:heading>
    </div>
    <div>
      <flux:button href="{{ $form->product->showUrl }}">
        Ver Producto
      </flux:button>
    </div>
  </div>

  <form class="space-y-4" wire:submit.prevent="save">
    <div class="flex flex-col gap-x-4 md:flex-row md:items-start md:justify-between">
      <div class="w-full space-y-4 md:w-6/12">
        {{-- Product Content --}}
        @include('livewire.admin.products.content')

        <div>
          <flux:button type="submit" variant="primary">
            Guardar
          </flux:button>
        </div>
      </div>

      <div class="w-full space-y-4 md:w-6/12">
        <flux:card class="space-y-4">
          <flux:heading>Estado</flux:heading>
          <flux:select wire:model="form.status">
            @foreach ($status as $item)
              <flux:select.option value="{{ $item->value }}">
                {{ $item->label() }}
              </flux:select.option>
            @endforeach
          </flux:select>
        </flux:card>
        <flux:card class="space-y-4">
          <flux:select label="Categoría" wire:model.live="form.selectedCategoryId">
            @foreach ($categories as $item)
              <flux:select.option value="{{ $item->id }}">
                {{ $item->localizedName }}
              </flux:select.option>
            @endforeach
          </flux:select>

          <flux:select label="Subcategoría" wire:model.live="form.selectedSubcategoryId">
            @foreach ($form->subcategories as $item)
              <flux:select.option value="{{ $item->id }}">
                {{ $item->localizedName }}
              </flux:select.option>
            @endforeach
          </flux:select>
        </flux:card>

        {{-- Product Gallery --}}
        <livewire:admin.products.gallery :product="$form->product" />

        {{-- Product Specifications --}}
        <livewire:admin.products.specifications :product="$form->product" />
      </div>
    </div>
  </form>
</div>
