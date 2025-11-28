@if (count($catalogs) > 0)
  <section class="swiper__catalogs bg-primary-50 overflow-clip py-10">
    <div class="swiper-wrapper">
      @foreach ($catalogs as $catalog)
        <figure class="swiper-slide overflow-clip rounded-sm">
          <img
            alt="{{ $catalog->localizedTitle }}"
            class="aspect-square w-full rounded-sm object-cover"
            src="{{ $catalog->fileUrl }}"
          >
        </figure>
      @endforeach
    </div>
  </section>
@endif

@push('scripts')
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      const catalogsSwiper = new Swiper('.swiper__catalogs', {
        loop: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: true,
        },
        slidesPerView: 1,
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          768: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 5,
            spaceBetween: 30,
          },
        },
        spaceBetween: 30,
        // grid: {
        //   rows: 2,
        // },
      });
    });
  </script>
@endpush
