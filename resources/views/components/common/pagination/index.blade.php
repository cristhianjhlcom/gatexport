<div>
  @if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" class="mx-auto flex items-center justify-center gap-4" role="navigation">
      <span>
        @if ($paginator->onFirstPage())
          <span>
            <flux:icon.chevron-left class="text-primary-400 opacity-40" size="6" />
          </span>
        @else
          <button rel="prev" wire:click="previousPage" wire:loading.attr="disabled">
            <flux:icon.chevron-left class="text-primary-400" size="6" />
          </button>
        @endif
      </span>

      @foreach ($elements as $element)
        @if (is_string($element))
          <span class="px-3 py-1 text-gray-400">{{ $element }}</span>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <span class="bg-primary-400 rounded-md px-3 py-1 font-medium text-white">{{ $page }}</span>
            @else
              <a class="text-primary-400 rounded-md px-3 py-1 hover:bg-[#f3b29c]/10" href="{{ $url }}">
                {{ $page }}
              </a>
            @endif
          @endforeach
        @endif
      @endforeach
      <span>
        @if ($paginator->onLastPage())
          <span>
            <flux:icon.chevron-right class="text-primary-400" size="6" />
          </span>
        @else
          <button rel="next" wire:click="nextPage" wire:loading.attr="disabled">
            <flux:icon.chevron-right class="text-primary-400 opacity-40" size="6" />
          </button>
        @endif
      </span>
    </nav>
  @endif
</div>
