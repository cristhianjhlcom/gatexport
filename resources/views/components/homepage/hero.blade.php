@props([
    'promotional_banners' => [],
])


@if (count($promotional_banners) > 0)
  <article class="overflow-hidden">
    <div class="swiper__hero relative h-[400px] bg-gray-300 md:h-[500px] lg:h-[600px]">
      <div class="swiper-wrapper h-full">
        @foreach ($promotional_banners as $banner)
          <a class="swiper-slide relative h-full w-full" href="{{ $banner['link_url'] }}">
            <img
              alt="{{ $banner['title'] }}"
              class="absolute inset-0 h-full w-full object-cover"
              src="{{ Storage::disk('public')->url($banner['image']) }}"
            />
            {{-- <div class="bg-primary-900/50 absolute inset-0"></div> --}}
            <div class="container relative z-10 h-full">
              <div class="flex h-full items-center py-8 md:py-12">
                <div class="w-full space-y-4 text-white md:w-4/5 md:space-y-6 lg:w-7/12">
                  {{-- <x-heading
                    level="2"
                    size="xl"
                    variant="white"
                    weight="black"
                  >
                    {{ $banner['title'] }}
                  </x-heading>
                  <x-text
                    size="xs"
                    variant="white"
                    weight="light"
                  >{{ $banner['short_description'] }}</x-text>
                  <flux:button
                    class="w-full sm:w-auto"
                    href="{{ $banner['link_url'] }}"
                    type="button"
                    variant="primary"
                  >
                    {{ $banner['link_text'] }}
                  </flux:button> --}}
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
      <div class="swiper-pagination swiper-pagination__hero"></div>
      {{--
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  --}}
    </div>
  </article>
@endif

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const heroSwiper = new Swiper('.swiper__hero', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination__hero',
          clickable: true,
        },
        // navigation: {
        //   nextEl: '.swiper-button-next',
        //   prevEl: '.swiper-button-prev',
        // },
      });
    });
  </script>

  <style>
    .swiper-pagination-bullet {
      width: 10px !important;
      height: 10px !important;
      margin: 0 6px !important;
      background-color: #ffffff !important;
    }
  </style>
@endpush
