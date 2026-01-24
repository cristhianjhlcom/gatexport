<form class="space-y-6" wire:submit="submit">
  <header>
    <flux:heading>
      {{ __('pages.contact.contact_us') }}
    </flux:heading>
    <flux:text class="mt-2">
      {{ __('pages.contact.contact_description') }}
    </flux:text>
  </header>
  <flux:separator />
  <div class="space-y-4">
    <flux:input badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.name') }}" placeholder="John Doe"
      wire:model="name" />
    <flux:input badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.email') }}" placeholder="john.doe@example.com"
      type="email" wire:model="email" />
    <flux:input badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.phone') }}" mask="999-999-999"
      placeholder="999-999-999" wire:model="phone" />
  </div>
  <div class="flex">
    <flux:spacer />
    <flux:button type="submit" variant="primary">
      {{ __('pages.contact.send') }}
    </flux:button>
  </div>
</form>
