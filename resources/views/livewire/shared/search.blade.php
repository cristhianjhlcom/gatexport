<flux:navbar>
  <flux:modal.trigger name="search" shortcut="cmd.k">
    <button type="button">
      <svg
        class="size-6"
        fill="none"
        stroke-width="1.5"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
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
