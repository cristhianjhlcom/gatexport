@props([
    'categories' => [],
])

@if (count($categories) > 0)
  <section class="bg-primary-50 py-10 md:py-14 dark:bg-gray-800">
    <div class="container space-y-6 overflow-hidden">
      <x-heading
        class="text-center"
        level="2"
        size="xl"
        weight="black"
      >
        {{ __('pages.home.products.title') }}
      </x-heading>

      @foreach ($categories as $idx => $category)
        <article class="space-y-4">
          <header class="flex w-full items-center justify-between">
            <x-heading level="2" size="lg">
              {{ $category->localizedName }}
            </x-heading>
          </header>
          <div class="space-y-4">
            @foreach ($category->subcategories as $subcategory)
              <header class="flex w-full items-center justify-between">
                <x-heading level="3" size="sm">
                  {{ $subcategory->localizedName }}
                </x-heading>
                <flux:button
                  href="{{ route('subcategories.index', [
                      'category' => $category,
                      'subcategory' => $subcategory,
                  ]) }}"
                  icon:trailing="arrow-right"
                  inset
                  size="sm"
                  variant="ghost"
                  wire:navigate
                >
                  {{ __('pages.categories.view_all') }}
                </flux:button>
              </header>

              <div class="swiper__featured-products">
                <div class="swiper-wrapper">
                  @foreach ($subcategory->products as $product)
                    <div class="swiper-slide">
                      <x-common.product-card :$product />
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
        </article>
      @endforeach
    </div>
  </section>
@endif

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const featuredProductsSwiper = new Swiper('.swiper__featured-products', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: true,
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
