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
        {{ __('Request') }}
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
        {{ __('Request') }}
      </flux:button>
    </div>
  </flux:modal.trigger>
  <flux:modal class="md:w-1/2 lg:w-1/3" name="call-to-action">
    <div class="space-y-6">
      <div>
        <flux:heading size="lg">
          {{ __('Request product') }}
        </flux:heading>
        <flux:text class="mt-2">
          {{ __('We need your information to contact you.') }}
        </flux:text>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <flux:input
          label="{{ __('First Name') }}"
          placeholder="{{ __('John') }}"
          wire:model="firstName"
        />
        <flux:input
          label="{{ __('Last Name') }}"
          placeholder="{{ __('Doe') }}"
          wire:model="lastName"
        />
      </div>
      <div class="grid grid-cols-2 gap-4">
        <flux:input
          label="{{ __('Email') }}"
          placeholder="{{ __('john@doe.com') }}"
          wire:model="email"
        />
        <flux:input
          label="{{ __('Phone Number') }}"
          mask="999-999-999"
          placeholder="{{ __('999-999-999') }}"
          wire:model="phone"
        />
      </div>
      <flux:textarea
        label="{{ __('Notes') }}"
        placeholder="{{ __('Notes') }}"
        wire:model="notes"
      />
      <div class="flex">
        <flux:spacer />
        <flux:button
          type="submit"
          variant="primary"
          wire:click="createOrder"
        >
          {{ __('Request') }}
        </flux:button>
      </div>
    </div>
  </flux:modal>
</section>
