<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags :title="$title ?? 'Gate Export SAC'" />
  </x-slot>

  <section class="bg-primary-50 space-y-10 md:space-y-20">
    <x-homepage.hero :$promotional_banners />
    <x-homepage.about :$about :$general_information />
    <x-homepage.advantages :$competitive_advantages />
    <x-homepage.categories :$highlighted_categories />
    <x-homepage.company-services :$company_services />
    <x-homepage.maps :$export_continents />
  </section>
</x-layouts.public>
