@props(['categories'])

<article class="bg-primary-50 py-10 md:py-14">
  <div class="container space-y-6 overflow-hidden">
    <x-heading
      class="text-center"
      level="2"
      size="xl"
      weight="black"
    >
      {{ __('pages.home.products.title') }}
    </x-heading>
    <div class="swiper__featured-products">
      <div class="swiper-wrapper">
        @foreach ($categories as $idx => $category)
          <a class="swiper-slide group relative overflow-hidden rounded-sm"
            href="{{ route('categories.show', $category->slug) }}"
          >
            <div class="absolute inset-0 bg-gray-800/50 transition-opacity group-hover:bg-gray-800/50"></div>
            <img
              alt="{{ $category->localizedName }}"
              class="aspect-square w-full object-cover"
              src="{{ $category->imageUrl }}"
            />
            <h3 class="absolute left-4 top-4 text-lg font-bold text-white md:text-xl">
              {{ $category->localizedName }}
            </h3>
          </a>
        @endforeach
      </div>
      <div class="swiper-pagination__featured-products"></div>
    </div>
  </div>
</article>

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const featuredProductsSwiper = new Swiper('.swiper__featured-products', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        breakpoints: {
          768: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
        },
      });
    });
  </script>
@endpush
