<x-layouts.public>
  <main class="container space-y-4 py-4">

    {{-- BREADCRUMBS --}}
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('home.index') }}" separator="slash">
        {{ __('Home') }}
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
      <div class="space-y-4">
        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-sm bg-gray-100">
          <img
            alt="{{ $product->name }}"
            class="h-full w-full object-cover object-center"
            src="{{ Storage::disk('public')->url($product->images[0]->path) }}"
          >
        </div>
        <div class="grid grid-cols-3 gap-4">
          @for ($i = 1; $i < 4; $i++)
            <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-sm bg-gray-100">
              <img
                alt="{{ $product->name }}"
                class="h-full w-full cursor-pointer object-cover object-center hover:opacity-75"
                src="{{ Storage::disk('public')->url($product->images[$i]->path) }}"
              >
            </div>
          @endfor
        </div>
      </div>

      <!-- Información del Producto -->
      <div class="space-y-6">
        <div class="space-y-2">
          <flux:breadcrumbs>
            <flux:breadcrumbs.item separator="slash">
              {{ $subcategory->category->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item separator="slash">
              {{ $subcategory->name }}
            </flux:breadcrumbs.item>
          </flux:breadcrumbs>
          <!-- Título y estado -->
          <flux:heading level="1" size="xl">{{ $product->name }}</flux:heading>
          <flux:text>{{ $product->seo_description }}</flux:text>
        </div>

        <!-- Call To Action -->
        <div
          class="border-t-1 fixed bottom-0 left-0 right-0 m-0 flex w-full items-center justify-center border-gray-200 bg-white/75 px-8 py-4"
        >
          <flux:button
            class="w-full"
            type="button"
            variant="primary"
          >
            {{ __('Request') }}
          </flux:button>
        </div>

        <flux:separator />

      </div>
    </section>

    <flux:tab.group>
      <flux:tabs>
        <flux:tab icon="user" name="description">{{ __('Description') }}</flux:tab>
        <flux:tab icon="cog-6-tooth" name="specifications">{{ __('Specifications') }}</flux:tab>
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

    <flux:separator text="{{ __('Related Products') }}" />

    {{-- Related Products --}}
    <section class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-5">
      @foreach ($subcategory->products as $product)
        <flux:link
          class="overflow-hidden"
          href="{{ route('products.show', [
              'category' => $product->subcategory->category,
              'subcategory' => $product->subcategory,
              'product' => $product,
          ]) }}"
          wire:navigate
        >
          <article class="flex flex-col items-center justify-center">
            <img
              alt="{{ $product->name }}"
              class="aspect-square h-auto w-full rounded-sm object-contain"
              src="{{ $product->getFirstImageAttribute() }}"
            >
            <main class="bg-white p-4">
              <h6 class="text-xs font-normal text-gray-800">
                {{ $product->name }}
              </h6>
            </main>
          </article>
        </flux:link>
      @endforeach
    </section>

  </main>
</x-layouts.public>
