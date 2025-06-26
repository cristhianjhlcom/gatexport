<flux:card class="space-y-6">
    <div>
        <flux:heading size="lg">Create your new account</flux:heading>
        <x-common.auth-session-status :status="session('status')" />
    </div>

    <form wire:submit="register" class="space-y-6">
        <flux:input :label="__('Name')" wire:model="name" autofocus autocomplete="name" required type="text"
            placeholder="John Doe" />
        <flux:input :label="__('Email')" wire:model="email" required type="email" placeholder="john.doe@email.com" />
        <flux:input :label="__('Password')" wire:model="password" required type="password" />
        <flux:input :label="__('Confirm Password')" wire:model="password_confirmation" required type="password" />

        <div class="space-y-2">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Register') }}
            </flux:button>
            <flux:button href="{{ route('login') }}" variant="ghost" class="w-full">
                {{ __('Already registered?') }}
            </flux:button>
        </div>
    </form>
</flux:card>
