<div class="space-y-4">
  <flux:heading>{{ __('Categories Management') }}</flux:heading>
  <flux:text class="mt-2">{{ __('Manage categories of the system.') }}</flux:text>
  <flux:separator />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div></div>
      <flux:button href="{{ route('admin.categories.create') }}" icon="plus">
        {{ __('Add Category') }}
      </flux:button>
    </div>

    <flux:table :paginate="$categories">
      <flux:table.columns>
        <flux:table.column>{{ __('Name') }}</flux:table.column>
        <flux:table.column>{{ __('Subcategory') }}</flux:table.column>
        <flux:table.column>{{ __('Date') }}</flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($categories as $category)
          <flux:table.row key="{{ $category->id }}">
            <flux:table.cell class="flex items-center gap-3 text-wrap">
              @if ($category->image)
                <img
                  alt="{{ $category->name }}"
                  class="h-10 w-10 rounded-lg object-contain"
                  src="{{ $category->getImagePathAttribute() }}"
                />
              @else
                <flux:avatar name="{{ $category->name }}" />
              @endif
              {{ $category->name }}
            </flux:table.cell>
            <flux:table.cell>
              {{ $category->subcategories_count }}
            </flux:table.cell>
            <flux:table.cell>{{ $category->formattedCreatedAt() }}</flux:table.cell>
            <flux:table.cell>
              <flux:dropdown align="end" position="bottom">
                <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
                <flux:menu>
                  <flux:menu.item href="{{ route('admin.categories.edit', $category) }}" icon="pencil">
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
