<x-layouts.public>
  <x-slot:seo>
    @php
      $emptySeoDescription = empty($category->seo_description[app()->getLocale()]);
      $description = $emptySeoDescription ? $category->seo_description[app()->getLocale()] : null;
      $emptySeoTitle = empty($category->seo_title[app()->getLocale()]);
      $title = !$emptySeoTitle ? $category->seo_description[app()->getLocale()] : $category->localizedName;
    @endphp

    <x-common.seo.tags
      :description="$description"
      :image="$category->seo_image"
      :title="$title"
    />
  </x-slot>

  <livewire:public.products.categories-catalog :$category :$subcategories />
</x-layouts.public>
