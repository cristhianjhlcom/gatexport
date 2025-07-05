<x-layouts.public>
  <main class="space-y-4">
    <flux:heading>{{ __('Sub Categories') }}</flux:heading>
    <flux:text class="mt-2">{{ __('List of sub categories.') }}</flux:text>
    <flux:separator />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($products as $product)
        <flux:card>
          <flux:heading>{{ $product->name }}</flux:heading>
        </flux:card>
      @endforeach
    </div>
  </main>
</x-layouts.public>
