<x-layouts.public :title="$title">
  <main class="space-y-6">
    @include('pages.about-us.hero')

    @include('pages.about-us.commitment')

    @include('pages.about-us.quality-control')

    @include('pages.about-us.certification')

    @include('pages.about-us.history')

    @include('pages.about-us.values')

    {{-- Contact Information --}}
    @if (count($general_information) > 0)
      <section class="bg-primary-50 py-10 dark:bg-gray-800">
        <div class="container grid grid-cols-1 items-start gap-8 py-10 md:grid-cols-2">
          <article class="space-y-4">
            <x-heading
              level="2"
              size="lg"
              weight="black"
            >
              {{ __('pages.contact.contact_information') }}
            </x-heading>

            <flux:text class="flex items-center gap-x-2">
              <flux:icon name="map-pin" />
              <span>{!! $general_information['contact_information']['address'] !!}</span>
            </flux:text>
            <flux:text class="flex items-center gap-x-2">
              <flux:icon name="device-phone-mobile" />
              <span>{!! $general_information['contact_information']['phone'] !!}</span>
            </flux:text>
            <flux:text class="flex items-center gap-x-2">
              <flux:icon name="device-phone-mobile" />
              <span>{!! $general_information['contact_information']['second_phone'] !!}</span>
            </flux:text>
            <a class="flex items-center gap-x-2"
              href="mailto:{{ $general_information['contact_information']['email'] }}"
            >
              <flux:icon name="envelope" />
              <span>{{ $general_information['contact_information']['email'] }}</span>
            </a>

          </article>
          {{-- Contact Form --}}
          <article class="space-y-4">
            <x-heading
              level="2"
              size="lg"
              weight="black"
            >
              {{ __('pages.contact.contact_us') }}
            </x-heading>
            <livewire:public.contact.contact-form />
          </article>
          {{-- #End Contact Form --}}
        </div>
      </section>
    @endif
    {{-- #Contact Information --}}
  </main>
</x-layouts.public>
