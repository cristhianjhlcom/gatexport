<x-layouts.public>
  <main class="space-y-4">
    <flux:heading>{{ __('Categories') }}</flux:heading>
    <flux:text class="mt-2">{{ __('List of categories.') }}</flux:text>
    <flux:separator />

    <div class="grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($categories as $category)
        @if ($category->subcategories_count > 0)
          <flux:card class="rounded-md">
            <header class="flex items-center justify-start gap-x-4">
              <flux:avatar name="{{ $category->name }}" />
              <flux:heading>{{ $category->name }} ({{ count($category->subcategories) }})</flux:heading>
            </header>
            <main>
              <ul>

                @foreach ($category->subcategories as $subcategory)
                  <li>
                    <a href="{{ route('subcategories.index', [
                        'category' => $category,
                        'subcategory' => $subcategory,
                    ]) }}"
                      wire:navigate
                    >
                      {{ $subcategory->name }}
                    </a>
                  </li>
                @endforeach

              </ul>
            </main>
          </flux:card>
        @endif
      @endforeach
    </div>
  </main>
</x-layouts.public>
