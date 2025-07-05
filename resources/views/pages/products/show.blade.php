<x-layouts.public>
  <main>
    <flux:heading>{{ __('Product') }}</flux:heading>
    <flux:text class="mt-2">{{ __('Product details.') }}</flux:text>
    <flux:separator />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      <flux:card>
        <flux:card.header>
          <flux:avatar name="{{ $product->name }}" />
          <flux:heading>{{ $product->name }}</flux:heading>
        </flux:card.header>
        <flux:card.body>
          <flux:text>{{ $product->description }}</flux:text>
        </flux:card.body>
        <flux:card.footer>
          Menu
        </flux:card.footer>
      </flux:card>
    </div>
  </main>
</x-layouts.public>
