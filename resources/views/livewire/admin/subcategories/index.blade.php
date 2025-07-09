<div class="space-y-4">
  <flux:heading>{{ __('Sub Categories Management') }}</flux:heading>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.subcategories.create') }}" icon="plus">
        {{ __('Add Sub Category') }}
      </flux:button>
    </div>

    <flux:table :paginate="$subcategories">
      <flux:table.columns>
        <flux:table.column>{{ __('Name') }}</flux:table.column>
        <flux:table.column>{{ __('Slug') }}</flux:table.column>
        <flux:table.column>{{ __('Products Count') }}</flux:table.column>
        <flux:table.column>{{ __('Category') }}</flux:table.column>
        <flux:table.column>{{ __('Date') }}</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($subcategories as $subcategory)
          <flux:table.row key="{{ $subcategory->id }}">
            <flux:table.cell class="flex items-center gap-3 text-wrap">
              @if ($subcategory->image)
                <img
                  alt="{{ $subcategory->name }}"
                  class="h-10 w-10 rounded-lg object-contain"
                  src="{{ $subcategory->getImagePathAttribute() }}"
                />
              @else
                <flux:avatar name="{{ $subcategory->name }}" />
              @endif
              {{ $subcategory->name }}
            </flux:table.cell>
            <flux:table.cell>
              {{ '/' . $subcategory->category->slug . '/' . $subcategory->slug }}
            </flux:table.cell>
            <flux:table.cell class="text-center">
              {{ $subcategory->products_count }}
            </flux:table.cell>
            <flux:table.cell>
              {{ $subcategory->category->name }}
            </flux:table.cell>
            <flux:table.cell>{{ $subcategory->formattedCreatedAt() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item href="{{ route('admin.subcategories.edit', $subcategory) }}" icon="pencil">
                    {{ __('Edit') }}
                  </flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>
