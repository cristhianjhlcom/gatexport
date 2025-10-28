<x-layouts.public :title="$title">
  <main>
    @include('pages.about-us.hero')
    @include('pages.about-us.commitment')
    @include('pages.about-us.quality-control')
    @include('pages.about-us.certification')
    @include('pages.about-us.history')
    @include('pages.about-us.values')
    <x-common.contact-section />
  </main>
</x-layouts.public>
