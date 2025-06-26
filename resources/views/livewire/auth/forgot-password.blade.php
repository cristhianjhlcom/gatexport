<flux:card class="space-y-6">
    <flux:heading>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </flux:heading>

    <!-- Session Status -->
    <x-common.auth-session-status :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <flux:input wire:model="email" type="email" placeholder="john.doe@email.com" required autofocus />
        <div class="flex items-center justify-end mt-4">
            <flux:button type="submit" variant="primary">
                {{ __('Email Password Reset Link') }}
            </flux:button>
        </div>
    </form>
</flux:card>
