<x-layouts.public :title="$title ?? 'Gate Export SAC'">
  <main class="bg-primary-50 space-y-10">
    <x-homepage.hero :$promotional_banners />
    <x-homepage.providers :$company_providers />
    <x-homepage.about :$about :$general_information />
    <x-homepage.advantages :$competitive_advantages />
    {{-- <x-homepage.products :$categories /> --}}
    <x-homepage.categories :$highlighted_categories />
    <x-homepage.company-services :$company_services />
    <x-homepage.maps :$export_continents />
  </main>
</x-layouts.public>
