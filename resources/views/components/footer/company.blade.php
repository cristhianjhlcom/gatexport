@props(['general_information', 'company_logos'])

<div class="flex flex-col justify-center space-y-4 md:col-span-5">
  <img alt="Gate Export" class="mx-auto h-12" src="{{ $company_logos['large_logo'] ?? asset('default-logo.png') }}" />

  <x-common.separator-line class="mx-auto w-full" color="border-white" pointColor="bg-white" />

  @if (!empty($general_information['translations']['company_short_description']))
    <p class="mb-4 text-gray-400">
      {{ $general_information['translations']['company_short_description'] }}
    </p>
  @endif
</div>
