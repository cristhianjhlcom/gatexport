<flux:navbar>
  <flux:modal.trigger name="search" shortcut="cmd.k">
    <button type="button">
      <x-icon.search @class([
          'size-6 text-white md:text-zinc-900',
          'text-white!' => request()->routeIs('home.index'),
      ]) />
    </button>
  </flux:modal.trigger>

  <flux:modal
    class="!radius-sm max-w-120 overflow-hidden! p-2! my-[12vh] max-h-screen w-full space-y-2 bg-white"
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
