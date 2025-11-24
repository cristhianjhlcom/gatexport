@props(['general_information'])

<div>
  <h3 class="mb-4 text-lg font-semibold">
    {{ __('layouts.footer.contact_information') }}
  </h3>
  <div class="space-y-4 text-gray-400">
    @if (!empty($general_information['contact_information']['phone']))
      <p class="flex items-center gap-x-2">
        <flux:icon name="device-phone-mobile" />
        <span>{{ $general_information['contact_information']['phone'] }}</span>
      </p>
    @endif
    @if (!empty($general_information['contact_information']['email']))
      <p class="flex items-center gap-x-2">
        <flux:icon name="envelope" />
        {{ $general_information['contact_information']['email'] ?? 'email@example.com' }}
      </p>
    @endif
  </div>
</div>
