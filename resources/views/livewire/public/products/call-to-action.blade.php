<section>
  <flux:modal.trigger name="call-to-action">
    <div
      class="border-t-1 fixed bottom-0 left-0 right-0 m-0 flex w-full items-center justify-center border-gray-200 bg-white/75 px-8 py-4 md:hidden"
    >
      <flux:button
        class="w-full"
        type="button"
        variant="primary"
      >
        {{ __('pages.product.request_product') }}
      </flux:button>
    </div>
  </flux:modal.trigger>
  <flux:modal.trigger name="call-to-action">
    <div class="hidden md:block">
      <flux:button
        class="w-full"
        type="button"
        variant="primary"
      >
        {{ __('pages.product.request_product') }}
      </flux:button>
    </div>
  </flux:modal.trigger>
  <flux:modal class="md:w-7/12" name="call-to-action">
    <form class="space-y-6" wire:submit="createOrder">
      <header>
        <flux:heading>
          {{ __('pages.product.request_title') }}
        </flux:heading>
        <flux:text class="mt-2">
          {{ __('pages.product.request_description') }}
        </flux:text>
      </header>
      <flux:separator />
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <flux:input
          badge="{{ __('pages.product.required') }}"
          label="{{ __('pages.product.first_name') }}"
          placeholder="John"
          wire:model="firstName"
        />
        <flux:input
          badge="{{ __('pages.product.required') }}"
          label="{{ __('pages.product.last_name') }}"
          placeholder="Doe"
          wire:model="lastName"
        />
      </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <flux:input
          badge="{{ __('pages.product.required') }}"
          label="{{ __('pages.product.email') }}"
          placeholder="john.doe@email.com"
          wire:model="email"
        />
        <flux:input
          badge="{{ __('pages.product.required') }}"
          label="{{ __('pages.product.phone') }}"
          mask="999-999-999"
          placeholder="999-999-999"
          wire:model="phone"
        />
      </div>
      <flux:textarea
        badge="{{ __('pages.product.required') }}"
        description:trailing="{{ __('pages.product.observation') }}"
        label="{{ __('pages.product.notes') }}"
        placeholder="Lorem ipsum..."
        wire:model="notes"
      />
      <div class="flex">
        <flux:spacer />
        <flux:button type="submit" variant="primary">
          {{ __('pages.product.request_product') }}
        </flux:button>
      </div>
      </div>
  </flux:modal>
</section>
