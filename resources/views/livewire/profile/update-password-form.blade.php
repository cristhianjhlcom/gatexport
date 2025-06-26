<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<flux:card class="space-y-4">
    <header>
        <flux:heading size="xl" level="1">{{ __('Update Password') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <flux:input wire:model="current_password" :label="__('Current Password')" type="password"
            autocomplete="current-password" />
        <flux:input wire:model="password" :label="__('New Password')" type="password" autocomplete="new-password" />
        <flux:input wire:model="password_confirmation" :label="__('Confirm Password')" type="password"
            autocomplete="new-password" />

        <div class="flex items-center gap-4">
            <flux:button type="submit" variant="primary">{{ __('Save') }}</flux:button>
            <x-common.action-message class="me-3" on="password-updated">
                {{ __('Saved.') }}
            </x-common.action-message>
        </div>
    </form>
</flux:card>
