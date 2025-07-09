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

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
      <!-- Galería de Imágenes -->
      <div class="space-y-4">
        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-100">
          <img
            alt="{{ $product->name }}"
            class="h-full w-full object-cover object-center"
            src="{{ Storage::disk('public')->url($product->images[0]->path) }}"
          >
        </div>
        <div class="grid grid-cols-4 gap-4">
          @for ($i = 1; $i < 4; $i++)
            <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-100">
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
        <!-- Título y estado -->
        <div>
          <h1 class="text-3xl font-semibold text-gray-900">
            {{ $product->name }}
          </h1>
        </div>

        <!-- Descripción -->
        <div class="mt-6">
          <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Description') }}
          </h2>
          <div class="prose prose-sm mt-2 text-gray-500">
            {!! $product->description !!}
          </div>
        </div>

        <!-- Call To Action -->
        <div class="mt-6">
          <flux:button type="button" variant="primary">
            {{ __('Request') }}
          </flux:button>
        </div>

        <!-- Especificaciones -->
        <div class="mt-6">
          <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Specifications') }}
          </h2>
          <dl class="mt-4 space-y-3">

            @foreach ($product->specifications as $specification)
              <div class="grid grid-cols-2 gap-4 rounded-lg bg-gray-50 px-4 py-3">
                <dt class="text-sm font-medium text-gray-500">{{ $specification->key }}</dt>
                <dd class="text-sm text-gray-900">{{ $specification->value }}</dd>
              </div>
            @endforeach

          </dl>
        </div>

      </div>
    </div>

  </main>
</x-layouts.public>
