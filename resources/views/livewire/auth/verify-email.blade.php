<flux:card class="space-y-6">
    <flux:heading>
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </flux:heading>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <flux:button variant="primary" wire:click="sendVerification">
            {{ __('Resend Verification Email') }}
        </flux:button>
        <flux:button variant="ghost" wire:click="logout" type="submit">
            {{ __('Log Out') }}
        </flux:button>
    </div>
</flux:card>
