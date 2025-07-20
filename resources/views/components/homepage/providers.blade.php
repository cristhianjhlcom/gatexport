@props([
    'company_providers' => [],
])

<section class="bg-primary-50 py-4">
  <div class="container overflow-hidden">
    <div class="swiper__providers">
      <div class="swiper-wrapper">
        @foreach ($company_providers as $provider)
          <article class="swiper-slide">
            <flux:tooltip content="{{ $provider['name'] }}" position="bottom">
              <img
                alt="{{ $provider['name'] }}"
                class="aspect-square h-40 w-40 rounded-sm object-cover"
                src="{{ Storage::disk('public')->url($provider['image']) }}"
              >
            </flux:tooltip>
          </article>
        @endforeach
      </div>
    </div>
  </div>
</section>

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const advantagesSwiper = new Swiper('.swiper__providers', {
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        slidesPerView: 2,
        spaceBetween: 10,
        breakpoints: {
          768: {
            slidesPerView: 5,
            spaceBetween: 5,
          },
        },
      });
    });
  </script>
@endpush
