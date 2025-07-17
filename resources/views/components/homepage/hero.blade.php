@props([
    'promotional_banners' => [],
])

<article class="swiper relative h-[400px] bg-gray-300 md:h-[500px] lg:h-[600px]">
  <div class="swiper-wrapper h-full">
    @foreach ($promotional_banners as $banner)
      <div class="swiper-slide relative h-full w-full">
        <img
          alt="{{ $banner['title'] }}"
          class="absolute inset-0 h-full w-full object-cover"
          src="{{ Storage::disk('public')->url($banner['image']) }}"
        />
        <div class="bg-primary-900/50 absolute inset-0"></div>
        <div class="container relative z-10 h-full">
          <div class="flex h-full items-center py-8 md:py-12">
            <div class="w-full space-y-4 text-white md:w-4/5 md:space-y-6 lg:w-3/4">
              <h3 class="text-4xl font-bold leading-tight md:text-6xl lg:text-7xl">
                {{ $banner['title'] }}
              </h3>
              <p class="max-w-2xl text-sm font-normal leading-relaxed md:text-base lg:text-lg">
                {{ $banner['short_description'] }}
              </p>
              <flux:button
                class="w-full md:w-auto"
                href="{{ $banner['link_url'] }}"
                type="button"
                variant="primary"
              >
                {{ $banner['link_text'] }}
              </flux:button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="swiper-pagination"></div>
  {{--
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  --}}
</article>

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const swiper = new Swiper('.swiper', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
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
      background-color: #ed7d31 !important;
    }
  </style>
@endpush
