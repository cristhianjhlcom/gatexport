@props([
    'competitive_advantages' => [],
])

@if (count($competitive_advantages) > 0)
  <section class="py-10 md:py-14">
    <div class="container space-y-6 overflow-hidden">
      <x-heading
        class="text-center"
        level="2"
        size="xl"
        weight="black"
      >
        {{ __('pages.home.advantages.title') }}
      </x-heading>
      <div class="swiper__advantages">
        <div class="swiper-wrapper">
          @foreach ($competitive_advantages as $advantage)
            <article
              class="swiper-slide border-primary-100 hover:bg-primary-100 bg-primary-50 dark:border-primary-900 dark:bg-primary-800 dark:hover:bg-primary-900 flex min-h-48 flex-col space-y-4 rounded-sm border p-6 transition-colors"
            >
              <header class="flex items-center justify-start gap-4">
                <img
                  alt="{{ $advantage['title'] }}"
                  class="hidden h-16 w-16 rounded-full object-cover md:block"
                  src="{{ Storage::disk('public')->url($advantage['image']) }}"
                >
                <x-heading
                  level="3"
                  size="xs"
                  weight="black"
                >
                  {{ $advantage['title'] }}
                </x-heading>
              </header>
              <flux:text class="mt-auto">
                {!! $advantage['description'] !!}
              </flux:text>
            </article>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const advantagesSwiper = new Swiper('.swiper__advantages', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        breakpoints: {
          768: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
        },
      });
    });
  </script>
@endpush
