@props([
    'promotional_banners' => [],
])


@if (count($promotional_banners) > 0)
  <article class="relative overflow-hidden">
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
      <div class="swiper-pagination swiper-pagination__hero"></div>
    </div>
    <div class="swiper-navigation__hero absolute hidden md:block">
      <div class="swiper-button-prev__hero"></div>
      <div class="swiper-button-next__hero"></div>
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
          disableOnInteraction: true,
        },
        pagination: {
          el: '.swiper-pagination__hero',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next__hero',
          prevEl: '.swiper-button-prev__hero',
        },
      });
    });
  </script>

  <style>
    .swiper-pagination-bullet {
      width: 30px !important;
      height: 10px !important;
      margin: 0 6px !important;
      border-radius: 20px;
      background-color: #ffffff !important;
    }

    @media screen and (min-width: 768px) {
      .swiper-pagination-bullet {
        width: 150px !important;
      }
    }
  </style>
@endpush
