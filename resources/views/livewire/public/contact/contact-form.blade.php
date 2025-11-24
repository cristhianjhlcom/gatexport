<form class="space-y-4" wire:submit.prevent="submit">
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <flux:input badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.name') }}" placeholder="John Doe" wire:model="name" />
    <flux:input badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.email') }}" placeholder="john.doe@example.com"
      wire:model="email" />
  </div>
  <flux:textarea badge="{{ __('pages.contact.required') }}" label="{{ __('pages.contact.message') }}" placeholder="lorem ipsum..."
    wire:model="message" />
  <div>
    <flux:button class="w-full" type="submit" variant="primary">
      {{ __('pages.contact.send') }}
    </flux:button>
  </div>
</form>
