<x-layouts.public :title="$title ?? 'Servicios de la Compañia'">
  <main class="bg-primary-50">
    @include('pages.services.hero')
    @include('pages.services.cycles')
    @include('pages.services.lists')
    @include('pages.services.authority')
    @include('pages.services.benefits')
    <x-common.contact-section />
  </main>
</x-layouts.public>
