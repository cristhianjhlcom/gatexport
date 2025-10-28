@props([
    'promotional_banners' => [],
])


@if (count($promotional_banners) > 0)
  <article class="overflow-hidden">
    <div class="swiper__hero relative h-[500px] bg-gray-300 md:h-[700px]">
      <div class="swiper-wrapper h-full">
        @foreach ($promotional_banners as $banner)
          <a class="swiper-slide relative h-full w-full" href="{{ $banner['link_url'] }}">
            @if (isset($banner['image_desktop']))
              <img
                alt="{{ $banner['title'] }}"
                class="absolute inset-0 hidden h-full w-full object-cover md:block"
                src="{{ Storage::disk('public')->url($banner['image_desktop']) }}"
              />
            @endif

            @if (isset($banner['image_mobile']))
              <img
                alt="{{ $banner['title'] }}"
                class="absolute inset-0 block h-full w-full object-cover md:hidden"
                src="{{ Storage::disk('public')->url($banner['image_mobile']) }}"
              />
            @endif
          </a>
        @endforeach
      </div>
      {{-- NOTE: Nuevo diseño.
        <div class="swiper-pagination swiper-pagination__hero"></div>
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
