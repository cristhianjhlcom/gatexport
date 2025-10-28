<section class="w-full bg-white py-10">
  <div class="container">
    @if (count($cycles) > 0)
      <article class="overflow-hidden">
        <div class="swiper__services__cycles relative">
          <div class="swiper-wrapper">
            @foreach ($cycles as $cycle)
              <div class="swiper-slide">
                <img
                  alt="{{ $cycle['title'] }}"
                  class="w-full object-contain"
                  src="{{ Storage::disk('public')->url($cycle['image']) }}"
                />
              </div>
            @endforeach
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </article>
    @endif
  </div>
</section>

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const heroSwiper = new Swiper('.swiper__services__cycles', {
        loop: true,
        autoplay: {
          delay: 7000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination__hero',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    });
  </script>

  <style>
    .swiper-button-prev,
    .swiper-button-next {
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

    .swiper-button-prev {
      left: 10px;
    }

    .swiper-button-next {
      right: 10px;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
      color: #ffffff;
      font-size: 18px;
    }

    .swiper-pagination-bullet {
      width: 10px !important;
      height: 10px !important;
      margin: 0 6px !important;
      background-color: #ffffff !important;
    }
  </style>
@endpush
