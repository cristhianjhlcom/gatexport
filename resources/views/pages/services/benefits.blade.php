@if (count($benefits) > 0)
  <section class="swiper__services__benefits bg-primary-500 relative overflow-hidden">
    <div class="swiper-wrapper">
      @foreach ($benefits as $benefit)
        <div class="swiper-slide">
          <img
            alt=""
            class="absolute bottom-0 left-0 right-0 top-0 hidden w-full lg:block"
            src="{{ Storage::disk('public')->url($benefit['background']) }}"
          />
          <div class="container py-10 md:py-20">
            <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-center">
              <header class="z-10 space-y-2 p-0 italic lg:p-20">
                <h4
                  class="text-shadow-lg text-lg font-extrabold capitalize leading-relaxed text-white md:text-3xl dark:text-white"
                >
                  {{ $benefit['title'] }}
                </h4>
                <p class="text-shadow-lg text-lg leading-relaxed text-white md:text-xl">{{ $benefit['description'] }}
                </p>
              </header>
              <img
                alt="{{ $benefit['title'] }}"
                class="z-10 w-full rounded-sm object-contain shadow-md"
                src="{{ Storage::disk('public')->url($benefit['image']) }}"
              />
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="swiper-pagination swiper-pagination__services__benefits"></div>
  </section>
@endif

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const benefitsSwiper = new Swiper('.swiper__services__benefits', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination__services__benefits',
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
      width: 150px !important;
      height: 10px !important;
      margin: 0 6px !important;
      border-radius: 20px;
      background-color: #ffffff !important;
    }
  </style>
@endpush
