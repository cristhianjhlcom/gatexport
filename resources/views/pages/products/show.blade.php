<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags
      :description="empty($product->localizedSeoDescription)
          ? $product->localizedDescription
          : $product->localizedSeoDescription"
      :image="Storage::disk('public')->url($product->firstImage)"
      :title="empty($product->localizedSeoTitle) ? $product->localizedName : $product->localizedSeoTitle"
    />
  </x-slot>

  <main class="space-y-10 pb-10">
    <section class="bg-primary-400 relative bg-cover bg-bottom py-10 text-white/95"
      style="background-image: url({{ $product->firstImage }});"
    >
      <div class="bg-primary-500/75 absolute inset-0 overflow-clip"></div>
      <div class="md:bg-primary-600/40 isolate mx-auto max-w-7xl rounded-xl bg-transparent p-4 md:p-14">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          <!-- Galería de Imágenes -->
          <livewire:public.products.gallery :images="$product->images" />

          <!-- Información del Producto -->
          <div class="space-y-6">
            <header>
              <h3 class="text-xl font-light leading-snug md:text-3xl">{{ $product->localizedCategoryName }}</h3>
              <h3 class="text-xl font-light leading-snug md:text-3xl">{{ $product->localizedSubcategoryName }}</h3>
              <h1 class="text-3xl font-extrabold italic leading-tight md:text-5xl">{{ $product->localizedName }}</h1>
            </header>
            <div class="h-0.5 w-full bg-white/75"></div>
            <div class="space-y-6">
              <div class="flex items-center gap-4">
                @foreach ($product->specifications as $spec)
                  <span>{{ $spec->value[app()->getLocale()]['value'] }}</span>
                @endforeach
              </div>

              <div class="prose prose-sm md:prose-md md:text-md space-y-2 text-sm leading-relaxed">
                {!! $product->localizedDescription !!}
              </div>
            </div>

            <div class="flex flex-col items-center gap-8 md:items-end">
              <div class="flex items-center gap-6">
                <p class="flex items-center gap-2">
                  <x-icon.share class="size-8" />
                  <span>{{ __('pages.product.share') }}</span>
                </p>
                <div class="flex items-center gap-2">
                  <x-icon.facebook class="size-8" fill="#fff" />
                  <x-icon.linkedin class="size-8" fill="#fff" />
                  <x-icon.youtube class="size-8" fill="#fff" />
                  <x-icon.whatsapp class="size-8" fill="#fff" />
                </div>
              </div>

              <!-- Call To Action -->
              <livewire:public.products.buy-button :$product />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container">
      <div class="items-center justify-center gap-4 space-y-4 text-white md:flex md:space-y-0">
        <div
          class="bg-primary-400 flex min-w-52 items-center justify-start gap-4 rounded-l-[40px] rounded-r-[40px] px-6 py-3 text-center md:justify-center md:rounded-r-none"
        >
          <x-icon.light-weight class="size-8" />
          <p>{!! __('pages.product.compact_lightweight') !!}</p>
        </div>
        <div
          class="bg-primary-400 flex min-w-52 items-center justify-start gap-4 rounded-[40px] px-6 py-3 text-center md:justify-center md:rounded-none"
        >
          <x-icon.hight-quality class="size-8" />
          <p>{!! __('pages.product.high_quality') !!}</p>
        </div>
        <div
          class="bg-primary-400 flex min-w-52 items-center justify-start gap-4 rounded-l-[40px] rounded-r-[40px] px-6 py-3 text-center md:justify-center md:rounded-l-none"
        >
          <x-icon.natural class="size-8" />
          <p>{!! __('pages.product.natural') !!}</p>
        </div>
      </div>
    </section>

    {{-- Related Products --}}
    @if (count($relatedProducts) > 0)
      <section class="container space-y-10">
        <header class="flex flex-col space-y-2">
          <x-common.title
            class="text-center"
            level="2"
            size="title"
            variant="primary"
            weight="font-extrabold"
          >
            {{ __('pages.product.related_products') }}
          </x-common.title>
          <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
        </header>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
          @foreach ($relatedProducts as $product)
            <x-common.product-card :$product />
          @endforeach
        </div>
      </section>
    @endif
  </main>
</x-layouts.public>
