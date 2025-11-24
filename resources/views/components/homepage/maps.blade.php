@props([
    'export_continents' => [],
])

@if (count($export_continents))
  <article class="relative bg-white py-10 md:py-16 lg:py-20">
    <div class="container space-y-6 overflow-hidden">
      <header class="flex flex-col space-y-4">
        <x-common.title class="text-center" level="2" size="title" variant="primary" weight="font-extrabold">
          {{ __('pages.home.countries_exports.title') }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
      </header>

      <div class="swiper__countries h-500 relative md:h-[600px]">
        <div class="swiper-wrapper h-full">
          @foreach ($export_continents as $continent)
            @if (isset($continent['image']))
              <div class="swiper-slide relative h-full w-full">
                <img alt="{{ $continent['title'] }}" class="aspect-auto h-full w-full bg-center object-contain"
                  src="{{ Storage::disk('public')->url($continent['image']) }}" />
              </div>
            @endif
          @endforeach
        </div>

      </div>

    </div>
    <div class="swiper-navigation__continents md:right-1/6 absolute bottom-0 right-0 z-30 flex space-x-4 p-4">
      <div class="swiper-button-prev__continents bg-primary-500 rounded-full p-2 text-white">
        <flux:icon.chevron-left size="6" />
      </div>
      <div class="swiper-button-next__continents bg-primary-500 rounded-full p-2 text-white">
        <flux:icon.chevron-right size="6" />
      </div>
    </div>
  </article>

  @push('scripts')
    <script defer>
      document.addEventListener('DOMContentLoaded', () => {
        const continentsSwiper = new Swiper('.swiper__countries', {
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: true,
          },
          slidesPerView: 1,
          navigation: {
            nextEl: '.swiper-button-next__continents',
            prevEl: '.swiper-button-prev__continents',
          },
        });
      });
    </script>
  @endpush

  @push('styles')
    <style>
      .swiper-button-next__continents,
      .swiper-button-prev__continents {
        color: #fff;
        z-index: 30;
      }

      .swiper-pagination-bullet-active {
        background-color: #ed7d31;
      }

      .country-bullet {
        font-size: 1.2rem;
        line-height: 1;
      }

      .continent-title {
        letter-spacing: 0.2em;
      }

      .continent-title-separator {
        width: 80px;
        margin-top: 10px;
      }
    </style>
  @endpush
@endif
