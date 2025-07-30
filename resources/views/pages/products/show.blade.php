<x-layouts.public :title="$product->name">
  <main class="container space-y-4 py-4">

    {{-- BREADCRUMBS --}}
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('layouts.navigation.home') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item
        href="{{ route('categories.show', [
            'category' => $subcategory->category,
        ]) }}"
        separator="slash"
      >
        {{ $subcategory->category->name }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item
        href="{{ route('subcategories.index', [
            'category' => $subcategory->category,
            'subcategory' => $subcategory,
        ]) }}"
        separator="slash"
      >
        {{ $subcategory->name }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item separator="slash">
        {{ $product->name }}
      </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- END BREADCRUMBS --}}

    <section class="grid grid-cols-1 gap-8 md:grid-cols-2">
      <!-- Galería de Imágenes -->
      <livewire:public.products.gallery :images="$product->images" />

      <!-- Información del Producto -->
      <div class="space-y-6">
        <div class="space-y-4">
          <flux:breadcrumbs>
            <flux:breadcrumbs.item separator="slash">
              {{ $subcategory->category->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item separator="slash">
              {{ $subcategory->name }}
            </flux:breadcrumbs.item>
          </flux:breadcrumbs>

          <!-- Título y estado -->
          <x-heading level="1" size="xl">
            {{ $product->name }}
          </x-heading>
          <flux:text>{{ $product->seo_description }}</flux:text>

          <dl class="divide-y divide-gray-200">
            @foreach ($product->specifications as $specification)
              <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4">
                <dt class="text-sm font-medium text-gray-500">{{ $specification->key }}</dt>
                <dd class="text-sm text-gray-900">{{ $specification->value }}</dd>
              </div>
            @endforeach
          </dl>
        </div>

        <!-- Call To Action -->
        <flux:separator />
        <livewire:public.products.buy-button :$product />

      </div>
    </section>

    <flux:tab.group>
      <flux:tabs>
        <flux:tab icon="user" name="description">
          {{ __('pages.product.description') }}
        </flux:tab>
        <flux:tab icon="cog-6-tooth" name="specifications">
          {{ __('pages.product.specifications') }}
        </flux:tab>
      </flux:tabs>
      <flux:tab.panel name="description">
        <div class="prose prose-sm md:prose-md md:text-md text-sm text-gray-500">
          {!! $product->description !!}
        </div>
      </flux:tab.panel>
      <flux:tab.panel name="specifications">
        <dl class="divide-y divide-gray-200">
          @foreach ($product->specifications as $specification)
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4">
              <dt class="text-sm font-medium text-gray-500">{{ $specification->key }}</dt>
              <dd class="text-sm text-gray-900">{{ $specification->value }}</dd>
            </div>
          @endforeach
        </dl>
      </flux:tab.panel>
    </flux:tab.group>

    <flux:separator text="{{ __('pages.product.related_products') }}" />

    {{-- Related Products --}}
    <section class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-5">
      @foreach ($subcategory->products as $product)
        <x-common.product-card :$product />
      @endforeach
    </section>

  </main>
</x-layouts.public>
