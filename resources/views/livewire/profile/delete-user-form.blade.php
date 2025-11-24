<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }

    public function closeModal(): void
    {
        Flux::modals()->close();
    }
}; ?>

<flux:card class="space-y-4">
  <header>
    <flux:heading size="xl" level="1">{{ __('Delete Account') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">
      {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </flux:subheading>
  </header>

  <flux:modal.trigger name="confirm-user-deletion">
    <flux:button variant="danger">
      {{ __('Delete Account') }}
    </flux:button>
  </flux:modal.trigger>

  <flux:modal name="confirm-user-deletion" class="space-y-6 md:w-96">
    <form wire:submit="deleteUser">
      <flux:heading size="lg" level="1">
        {{ __('Are you sure you want to delete your account?') }}
      </flux:heading>
      <flux:subheading class="mb-6">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
      </flux:subheading>

      <flux:input wire:model="password" type="password" :label="__('Password')" :placeholder="__('Password')" />

      <div class="mt-6 flex justify-end gap-x-2">
        <flux:button wire:click="closeModal">
          {{ __('Cancel') }}
        </flux:button>
        <flux:button type="submit" variant="danger">
          {{ __('Delete Account') }}
        </flux:button>
      </div>
    </form>
  </flux:modal>
</flux:card>
