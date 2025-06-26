@props(['status'])

@if ($status)
    <flux:badge size="sm">{{ $status }}</flux:badge>
@endif
