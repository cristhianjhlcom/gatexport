@props([
    'company_services' => [],
])

<section class="py-10 md:py-16 lg:py-20" id="services">
  <div class="mx-auto w-full max-w-[800px] px-8 md:px-8">
    <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">
      {{ __('Company Services') }}
    </h2>
    <flux:accordion>
      @foreach ($company_services as $service)
        <flux:accordion.item>
          <flux:accordion.heading>{{ $service['title'] }}</flux:accordion.heading>

          <flux:accordion.content>
            {!! $service['description'] !!}
          </flux:accordion.content>
        </flux:accordion.item>
      @endforeach
    </flux:accordion>
  </div>
</section>
