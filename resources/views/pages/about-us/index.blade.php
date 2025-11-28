<x-layouts.public :title="$title">
  <x-slot:seo>
    <x-common.seo.tags :title="__('pages.about.title')" />
  </x-slot>
  <main>
    @include('pages.about-us.hero')
    @include('pages.about-us.commitment')
    @include('pages.about-us.quality-control')
    @include('pages.about-us.catalogs')
    @include('pages.about-us.certification')
    @include('pages.about-us.history')
    @include('pages.about-us.values')
    <x-common.contact-section />
  </main>
</x-layouts.public>
