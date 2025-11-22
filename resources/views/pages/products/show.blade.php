<x-layouts.public :title="empty($product->localizedSeoTitle) ? $product->localizedName : $product->localizedSeoTitle">
  <main>
    <section class="bg-primary-400 relative bg-cover py-10 text-white/95"
      style="background-image: url({{ $product->firstImage }});"
    >
      <div class="bg-primary-500/75 absolute inset-0 overflow-clip"></div>
      <div class="bg-primary-600/40 isolate mx-auto max-w-7xl rounded-xl p-14">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          <!-- Galería de Imágenes -->
          <livewire:public.products.gallery :images="$product->images" />

          <!-- Información del Producto -->
          <div class="space-y-6">
            <header>
              <h3 class="text-3xl font-light leading-snug">{{ $product->localizedCategoryName }}</h3>
              <h3 class="text-3xl font-light leading-snug">{{ $product->localizedSubcategoryName }}</h3>
              <h1 class="text-5xl font-extrabold italic leading-tight">{{ $product->localizedName }}</h1>
            </header>
            <div class="h-0.5 w-full bg-white/75"></div>
            <div class="space-y-4">
              <div class="flex items-center gap-4">
                @foreach ($product->specifications as $spec)
                  <span>{{ $spec->value[app()->getLocale()]['value'] }}</span>
                @endforeach
              </div>

              <div class="prose prose-sm md:prose-md md:text-md space-y-2 text-sm leading-relaxed">
                {!! $product->localizedDescription !!}
              </div>
            </div>
            <!-- Call To Action -->
            <livewire:public.products.buy-button :$product />
          </div>
        </div>
      </div>
    </section>

    {{-- Related Products --}}
    @if (count($relatedProducts) > 0)
      <section class="container">
        <flux:separator text="{{ __('pages.product.related_products') }}" />

        <section class="grid grid-cols-2 gap-4 md:grid-cols-4">
          @foreach ($relatedProducts as $product)
            <x-common.product-card :$product />
          @endforeach
        </section>
        </div>
    @endif
  </main>
</x-layouts.public>
