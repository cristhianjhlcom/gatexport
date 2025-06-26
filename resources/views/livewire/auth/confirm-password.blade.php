<flux:card class="space-y-6">
    <flux:heading>
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </flux:heading>
    <form wire:submit="confirmPassword">
        <flux:input wire:model="password" :label="__('Password')" type="password" required
            autocomplete="current-password" />
        <div class="flex justify-end mt-4">
            <flux:button variant="primary" type="submit">
                {{ __('Confirm') }}
            </flux:button>
        </div>
    </form>
</flux:card>
