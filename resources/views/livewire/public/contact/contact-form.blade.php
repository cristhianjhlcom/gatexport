<form class="space-y-4" wire:submit.prevent="submit">
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <flux:input
      label="Nombre"
      placeholder="Nombre"
      wire:model="name"
    />
    <flux:input
      label="Email"
      placeholder="Email"
      wire:model="email"
    />
  </div>
  <flux:textarea
    label="Mensaje"
    placeholder="Mensaje"
    wire:model="message"
  />
  <div>
    <flux:button
      class="w-full"
      type="submit"
      variant="primary"
    >
      {{ __('Send') }}
    </flux:button>
  </div>
</form>
