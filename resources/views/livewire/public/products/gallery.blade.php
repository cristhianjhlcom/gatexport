<section class="space-y-4">
  <div class="product-gallery-swiper swiper relative">
    <div class="swiper-wrapper">
      @foreach ($this->images as $image)
        <div class="swiper-slide">
          <img
            alt="Gallery Image"
            class="h-full w-full rounded-sm object-contain""
            src="{{ Storage::disk('public')->url($image->path) }}"
          >

          <div x-data="{ open: false }">
            <button
              @click="open = true; $refs.modal.showModal()"
              class="absolute bottom-3 right-3 flex items-center justify-center rounded-full border border-zinc-400 bg-white p-2"
              type="button"
            >
              <x-icon.arrow-pointing-out class="size-6 text-gray-700" />
            </button>

            <dialog
              @click="
                  if ($event.target === $refs.modal) {
                      $refs.modal.close()
                  }
              "
              @close="open = false"
              class="dialog-backdrop rounded-sm p-0"
              x-ref="modal"
            >
              <div class="relative">
                <img
                  alt="Gallery Image"
                  class="h-full w-full rounded-sm object-contain"
                  src="{{ Storage::disk('public')->url($image->path) }}"
                >

                <!-- Botón para cerrar -->
                <button @click="$refs.modal.close()"
                  class="absolute right-3 top-3 rounded-full border-zinc-400 bg-white p-2 text-black"
                >
                  <x-icon.x-mark class="size-6 text-gray-700" />
                </button>
              </div>
            </dialog>
          </div>

          {{--
          <flux:modal.trigger name="show-{{ $image->path }}">
            <flux:button class="absolute bottom-12 left-0" variant="filled">
              <x-icon.arrow-pointing-out class="size-6 text-gray-900" />
            </flux:button>
          </flux:modal.trigger>

          <flux:modal
            class="p-0! max-w-[800px]"
            closable="false"
            name="show-{{ $image->path }}"
          >
            <img
              alt="Gallery Image"
              class="h-full w-full rounded-sm object-contain""
              src="{{ Storage::disk('public')->url($image->path) }}"
            >
          </flux:modal>
          --}}
        </div>
      @endforeach
    </div>
    <div class="swiper-button-next">
      <flux:icon.chevron-right class="size-6" />
    </div>
    <div class="swiper-button-prev">
      <flux:icon.chevron-left class="size-6" />
    </div>
  </div>

  <div class="product-gallery-thumbs-swiper swiper" thumbsSlider="">
    <div class="swiper-wrapper">
      @foreach ($this->images as $image)
        <div class="swiper-slide">
          <img
            alt="Gallery Image"
            class="h-full w-full rounded-sm object-contain"
            src="{{ Storage::disk('public')->url($image->path) }}"
          >
        </div>
      @endforeach
    </div>
</section>

@push('styles')
  <style>
    .product-gallery-thumbs-swiper .swiper-slide {
      width: 25%;
      height: 100%;
      opacity: 0.8;
    }

    .product-gallery-thumbs-swiper .swiper-slide-thumb-active {
      opacity: 1;
    }

    .swiper-button-next,
    .swiper-button-prev {
      background-color: #fff;
      border-radius: 100%;
      width: 25px;
      height: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #525252;
      font-size: 10px;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
      display: none;
    }
  </style>
@endpush

@script
  <script>
    const productGalleryThumbsSwiper = new Swiper(".product-gallery-thumbs-swiper", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });

    const productGallery = new Swiper(".product-gallery-swiper", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: productGalleryThumbsSwiper,
      },
      zoom: {
        maxRatio: 3,
      },
    });
  </script>
@endscript
