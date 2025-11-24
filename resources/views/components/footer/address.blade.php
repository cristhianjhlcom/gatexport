@props(['general_information'])

@if (!empty($general_information['contact_information']['address']))
  <div>
    <h3 class="mb-4 text-lg font-semibold">
      {{ __('layouts.footer.address') }}
    </h3>

    <address class="flex items-center gap-x-2 not-italic text-gray-400">
      <flux:icon name="map-pin" />
      <p>{{ $general_information['contact_information']['address'] }}</p>
    </address>
  </div>
@endif
