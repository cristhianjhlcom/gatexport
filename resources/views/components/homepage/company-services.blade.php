@props([
    'company_services' => [],
])

<section class="py-6 md:py-10 lg:py-14" id="services">
  <div class="container">
    <div class="flex items-start justify-start gap-4 md:flex-row md:gap-12">
      <div class="hidden overflow-hidden rounded-sm sm:block">
        <img
          alt="Nuestra Historia"
          class="aspect-square w-full object-contain"
          src="{{ Storage::disk('public')->url($company_services['main_image']) }}"
        >
      </div>
      <div class="flex-1 justify-start space-y-4 md:space-y-6">
        <x-heading
          class="text-center sm:text-left"
          level="2"
          size="lg"
          weight="black"
        >
          {{ __('Company Services') }}
        </x-heading>
        <flux:separator />
        <flux:accordion class="w-full">
          @foreach ($company_services['services'] as $service)
            <flux:accordion.item :key="$service['title']">
              <flux:accordion.heading>{{ $service['title'] }}</flux:accordion.heading>

              <flux:accordion.content>
                {!! $service['description'] !!}
              </flux:accordion.content>
            </flux:accordion.item>
          @endforeach
        </flux:accordion>
      </div>
    </div>
  </div>
</section>
