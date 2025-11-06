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
      <div class="swiper-pagination swiper-pagination__hero"></div>
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
          disableOnInteraction: false,
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
    /* .swiper-button-prev__hero,
      .swiper-button-next__hero {
        position: absolute;
        top: 10%;
        z-index: 10;
        width: 40px;
        height: 40px;
        background-color: #ff6600;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .swiper-button-prev__hero {
        left: 10px;
      }

      .swiper-button-next__hero {
        right: 10px;
      }

      .swiper-button-prev__hero::after,
      .swiper-button-next__hero::after {
        color: #ffffff;
        font-size: 18px;
      } */

    .swiper-pagination-bullet {
      width: 150px !important;
      height: 10px !important;
      margin: 0 6px !important;
      border-radius: 20px;
      background-color: #ffffff !important;
    }
  </style>
@endpush
