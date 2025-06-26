<flux:card class="space-y-6">
    <form wire:submit="resetPassword" class="space-y-4">
        <flux:input wire:model="email" :label="__('Email')" type="email" placeholder="john.doe@email.com" required
            autofocus autocomplete="username" />
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password" />
        <flux:input wire:model="password_confirmation" :label="__('Password Confirmation')" type="password" required
            autocomplete="new-password" />
        <div class="flex items-center justify-end mt-4">
            <flux:button type="submit" variant="primary">
                {{ __('Reset Password') }}
            </flux:button>
        </div>
    </form>
</flux:card>
