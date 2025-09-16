<x-layouts.public :title="empty($product->localizedSeoTitle) ? $product->localizedName : $product->localizedSeoTitle">
  <main class="container space-y-4 py-4">

    {{-- DESKTOP BREADCRUMBS --}}
    <flux:breadcrumbs class="hidden md:flex">
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('layouts.navigation.home') }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item
        href="{{ route('categories.show', [
            'category' => $subcategory->category,
        ]) }}"
        separator="slash"
      >
        {{ $product->localizedCategoryName }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item
        href="{{ route('subcategories.index', [
            'category' => $subcategory->category,
            'subcategory' => $subcategory,
        ]) }}"
        separator="slash"
      >
        {{ $product->localizedSubcategoryName }}
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item separator="slash">
        {{ $product->localizedName }}
      </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- END DESKTOP BREADCRUMBS --}}

    {{-- MOBILE BREADCRUMBS --}}
    <flux:breadcrumbs class="flex md:hidden">
      <flux:breadcrumbs.item href="{{ route('home.index') }}" icon="home" />
      <flux:breadcrumbs.item>
        <flux:dropdown>
          <flux:button
            icon="ellipsis-horizontal"
            size="sm"
            variant="ghost"
          />
          <flux:navmenu>
            <flux:navmenu.item
              href="{{ route('categories.show', [
                  'category' => $subcategory->category,
              ]) }}"
            >{{ $product->localizedCategoryName }}</flux:navmenu.item>
            <flux:navmenu.item
              href="{{ route('subcategories.index', [
                  'category' => $subcategory->category,
                  'subcategory' => $subcategory,
              ]) }}"
            >{{ $product->localizedSubcategoryName }}</flux:navmenu.item>
          </flux:navmenu>
        </flux:dropdown>
      </flux:breadcrumbs.item>
      <flux:breadcrumbs.item>{{ $product->localizedName }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    {{-- MOBILE BREADCRUMBS --}}

    <section class="grid grid-cols-1 gap-8 md:grid-cols-2">
      <!-- Galería de Imágenes -->
      <livewire:public.products.gallery :images="$product->images" />

      <!-- Información del Producto -->
      <div class="space-y-6">
        <div class="space-y-4">
          <flux:breadcrumbs>
            <flux:breadcrumbs.item separator="slash">
              {{ $product->localizedCategoryName }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item separator="slash">
              {{ $product->localizedSubcategoryName }}
            </flux:breadcrumbs.item>
          </flux:breadcrumbs>

          <!-- Título y estado -->
          <x-heading level="1" size="xl">
            {{ $product->localizedName }}
          </x-heading>

          @if ($product->localizedSeoDescription)
            <flux:text>{{ $product->localizedSeoDescription }}</flux:text>
          @else
            <div class="prose prose-sm md:prose-md md:text-md text-sm text-gray-500">
              {!! $product->localizedDescription !!}
            </div>
          @endif

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
        @if ($product->localizedDescription)
          <flux:tab icon="user" name="description">
            {{ __('pages.product.description') }}
          </flux:tab>
        @endif

        @if (count($product->specifications) > 0)
          <flux:tab icon="cog-6-tooth" name="specifications">
            {{ __('pages.product.specifications') }}
          </flux:tab>
        @endif
      </flux:tabs>

      @if ($product->localizedDescription)
        <flux:tab.panel name="description">
          <div class="prose prose-sm md:prose-md md:text-md text-sm text-gray-500">
            {!! $product->localizedDescription !!}
          </div>
        </flux:tab.panel>
      @endif

      @if (count($product->specifications) > 0)
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
      @endif
    </flux:tab.group>

    {{-- Related Products --}}
    @if (count($relatedProducts) > 0)
      <flux:separator text="{{ __('pages.product.related_products') }}" />

      <section class="grid grid-cols-2 gap-4 md:grid-cols-4">
        @foreach ($relatedProducts as $product)
          <x-common.product-card :$product />
        @endforeach
      </section>
    @endif

  </main>
</x-layouts.public>
