<div class="space-y-4">
  <flux:heading>{{ __('Products Management') }}</flux:heading>
  <flux:text class="mt-2">{{ __('Manage products of the system.') }}</flux:text>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.products.create') }}" icon="plus">
        {{ __('Add Product') }}
      </flux:button>
    </div>

    <flux:table :paginate="$products">
      <flux:table.columns>
        <flux:table.column>{{ __('Name') }}</flux:table.column>
        <flux:table.column>{{ __('Specifications') }}</flux:table.column>
        <flux:table.column>{{ __('Descriptions') }}</flux:table.column>
        <flux:table.column>{{ __('Status') }}</flux:table.column>
        <flux:table.column>{{ __('Subcategory') }}</flux:table.column>
        <flux:table.column>{{ __('Date') }}</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($products as $product)
          <flux:table.row key="{{ $product->id }}">
            <flux:table.cell class="flex items-center gap-3 text-wrap">
              <flux:avatar name="{{ $product->name }}" />
              {{ str()->words($product->name, 3) }}
            </flux:table.cell>
            <flux:table.cell class="text-center">
              {{ $product->specifications_count }}
            </flux:table.cell>
            <flux:table.cell class="text-wrap">
              {!! str()->limit($product->description, 100) !!}
            </flux:table.cell>
            <flux:table.cell>
              <flux:badge color="{{ $product->status->color() }}">
                {{ $product->status->label() }}
              </flux:badge>
            </flux:table.cell>
            <flux:table.cell>
              {{ $product->subcategory->name }}
            </flux:table.cell>
            <flux:table.cell>{{ $product->createdAtHuman() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item href="{{ route('admin.products.show', $product) }}" icon="eye">
                    {{ __('View') }}
                  </flux:menu.item>
                  <flux:menu.item href="{{ route('admin.products.edit', $product) }}" icon="pencil">
                    {{ __('Edit') }}
                  </flux:menu.item>
                  <flux:menu.item
                    icon="trash"
                    variant="danger"
                    wire:click="delete({{ $product }})"
                    wire:confirm.prevent="{{ __('Are you sure you want to delete this product?') }}"
                  >
                    {{ __('Archive') }}
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
