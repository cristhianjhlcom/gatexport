<flux:navbar>
  <flux:modal.trigger name="search" shortcut="cmd.k">
    <flux:button
      flat
      icon="magnifying-glass"
      size="sm"
      variant="ghost"
    />
  </flux:modal.trigger>

  <flux:modal
    class="!radius-sm my-[12vh] max-h-screen w-full max-w-[30rem] space-y-2 !overflow-hidden bg-white !p-2"
    name="search"
    style="border-radius: 0.5rem !important;"
    variant="bare"
  >
    <flux:input
      icon="magnifying-glass"
      placeholder="{{ __('layouts.navigation.search') }}..."
      wire:model.live.debounce.500ms="search"
    />
    @if ($this->search !== '')
      <ul>
        @forelse($this->products as $product)
          <li :key="$product->id">
            <flux:button
              class="flex w-full items-center justify-start gap-x-4"
              href="{{ $product->showUrl }}"
              variant="ghost"
            >
              <flux:avatar size="sm" src="{{ $product->firstImage }}" />
              <flux:text>{{ $product->localizedName }}</flux:text>
            </flux:button>
          </li>
        @empty
          <li>
            <flux:text>{{ __('layouts.navigation.no_results') }}</flux:text>
          </li>
        @endforelse
      </ul>
    @endif
  </flux:modal>
</flux:navbar>
