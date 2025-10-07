@props([
    'competitive_advantages' => [],
])

@if (count($competitive_advantages) > 0)
  <section class="bg-primary-50 space-y-10 dark:bg-gray-800" id="advantages">
    <div class="container space-y-16 overflow-hidden">

      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="2"
          size="title"
          variant="primary"
          weight="font-extrabold"
        >
          {{ __('pages.home.advantages.title') }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
      </header>

      <div class="swiper__advantages">
        <div class="swiper-wrapper">
          @foreach ($competitive_advantages as $advantage)
            <article class="swiper-slide flex flex-col items-center justify-center space-y-4 text-center">
              <img
                alt="{{ $advantage['title'] }}"
                class="mx-auto aspect-square h-16 w-16 object-cover"
                src="{{ Storage::disk('public')->url($advantage['image']) }}"
              >

              <x-common.title
                level="3"
                size="sub-title"
                variant="secondary"
                weight="font-bold"
              >
                {{ $advantage['title'] }}
              </x-common.title>
              {{-- NOTE: Por rediseño esta sección se oculta temporalmente
              <flux:text class="mt-auto">
                {!! $advantage['description'] !!}
              </flux:text>
              --}}
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
        slidesPerView: 2,
        spaceBetween: 10,
        breakpoints: {
          768: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 7,
            spaceBetween: 20,
          },
        },
      });
    });
  </script>
@endpush
