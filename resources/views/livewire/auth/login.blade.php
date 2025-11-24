<flux:card class="space-y-6">
  <div>
    <flux:heading size="lg">Log in to your account</flux:heading>
    <flux:subheading>Welcome back!</flux:subheading>
    <x-common.auth-session-status :status="session('status')" />
  </div>

  <form wire:submit="login" class="space-y-6">
    <flux:input :label="__('Email')" wire:model="form.email" autofocus autocomplete="username" required type="email"
      placeholder="Your email address" />

    <flux:field>
      <div class="mb-3 flex justify-between">
        <flux:label>Password</flux:label>

        @if (Route::has('password.request'))
          <flux:link href="{{ route('password.request') }}" wire:navigate variant="subtle" class="text-sm">
            {{ __('Forgot password?') }}
          </flux:link>
        @endif
      </div>

      <flux:input wire:model="form.password" required autocomplete="current-password" type="password" placeholder="Your password" />

      <flux:error name="password" />
    </flux:field>

    <div class="space-y-2">
      <flux:button type="submit" variant="primary" class="w-full">
        {{ __('Login') }}
      </flux:button>
      <flux:button href="{{ route('register') }}" variant="ghost" class="w-full">
        {{ __('Create a new account') }}
      </flux:button>
    </div>
  </form>
</flux:card>
