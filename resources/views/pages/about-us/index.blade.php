<x-layouts.public :title="$title">
  <main class="space-y-6">
    {{-- History Information --}}
    <section class="container space-y-6">
      <div class="flex flex-col items-start justify-start gap-8 py-10 md:flex-row md:gap-12">
        <div class="max-w-[500px]">
          @if ($about)
            <img
              alt="{{ __('pages.about.title') }}"
              class="aspect-square h-[500px] w-full rounded-sm object-cover"
              src="{{ Storage::disk('public')->url($about['first_image']) }}"
            />
          @endif
        </div>
        <article class="flex-1 space-y-4">

          <header class="space-y-4">
            @if ($general_information)
              <x-heading
                level="1"
                size="lg"
                weight="black"
              >
                {{ $general_information['translations']['company_name'] }}
              </x-heading>
              {{-- <flux:text class="prose lg:prose-xl">
                {!! $general_information['translations']['company_short_description'] !!}
              </flux:text> --}}
            @endif
          </header>


          @if ($general_information)
            <flux:text class="prose lg:prose-xl space-y-2">
              {!! $general_information['translations']['company_description'] !!}
            </flux:text>
          @endif

          @if ($general_information)
            <flux:button
              download
              href="{{ Storage::disk('public')->url($general_information['catalog_document']) }}"
              icon:trailing="document-arrow-down"
              variant="primary"
            >
              {{ __('pages.about.download_catalog_document') }}
            </flux:button>
          @endif
        </article>
      </div>
    </section>
    {{-- #End History Information --}}

    {{-- Proveedores --}}
    @if (count($providers) > 0)
      <section class="bg-primary-50 py-4 dark:bg-gray-800">
        <div class="container overflow-hidden">
          @if ($providers)
            <div class="swiper__about">
              <div class="swiper-wrapper">
                @foreach ($providers as $provider)
                  <article class="swiper-slide">
                    <flux:tooltip content="{{ $provider['name'] }}" position="bottom">
                      <img
                        alt="{{ $provider['name'] }}"
                        class="aspect-square h-40 w-40 rounded-sm object-cover"
                        src="{{ Storage::disk('public')->url($provider['image']) }}"
                      >
                    </flux:tooltip>
                  </article>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </section>

      @push('scripts')
        <script>
          window.addEventListener('DOMContentLoaded', (event) => {
            const advantagesSwiper = new Swiper('.swiper__about', {
              loop: true,
              autoplay: {
                delay: 3000,
                disableOnInteraction: false,
              },
              slidesPerView: 2,
              spaceBetween: 10,
              breakpoints: {
                768: {
                  slidesPerView: 5,
                  spaceBetween: 5,
                },
              },
            });
          });
        </script>
      @endpush
    @endif
    {{-- #End Proveedores --}}

    {{-- Mission and Vision --}}
    @if (count($about) > 0)
      <section class="container space-y-6">
        <div class="grid grid-cols-1 items-center gap-8 py-10 md:grid-cols-2">
          <article class="space-y-4">
            @if ($about['translations']['mission'])
              <x-heading
                level="2"
                size="lg"
                weight="black"
              >
                {{ __('pages.about.mission') }}
              </x-heading>

              <flux:text>
                {!! $about['translations']['mission'] !!}
              </flux:text>
              <flux:separator />
            @endif

            @if ($about['translations']['vision'])
              <x-heading
                level="2"
                size="lg"
                weight="black"
              >
                {{ __('pages.about.vision') }}
              </x-heading>

              <flux:text>
                {!! $about['translations']['vision'] !!}
              </flux:text>
            @endif
          </article>

          <article class="space-y-4">
            @if ($about && $about['youtube_video_id'])
              <div class="w-full">
                <lite-youtube videoid="{{ $about['youtube_video_id'] }}"></lite-youtube>
              </div>
            @endif
          </article>
        </div>
      </section>
    @endif
    {{-- #End Mission and Vision --}}

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
