<x-layouts.public :title="$subcategory->localizedName">
  <x-slot:seo>
    <x-common.seo.tags :title="__('layouts.navigation.subcategories')" />
  </x-slot>

  <livewire:public.products.subcategories-catalog :$subcategory />
</x-layouts.public>
