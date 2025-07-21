<article class="py-10 md:py-16 lg:py-20">
  <div class="container space-y-6">
    <x-heading
      class="text-center"
      level="2"
      size="xl"
      weight="black"
    >
      {{ __('pages.home.countries_exports.title') }}
    </x-heading>
    <div
      class="md:!h-[750px]"
      id="map"
      style="height: 170px; width: 100%;"
    ></div>
  </div>
</article>

@push('scripts')
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      const map = new jsVectorMap({
        selector: '#map',
        map: 'world',
        selectedRegions: ['EG', 'PE', 'VE', 'US'],
        backgroundColor: '#ffffff',
        zoomOnScroll: false,
        zoomOnScrollSpeed: 0.5,
        regionLabelStyle: {
          initial: {
            fill: '#faa41a', // accent color for labels
          },
        },
        regionStyle: {
          initial: {
            fill: '#e4e4e4',
            stroke: '#fff',
            'stroke-width': 1,
          },
          selected: {
            fill: '#ed7d31',
          },
        },
        responsive: true,
        onRegionClick: (region) => {
          console.log(region);
        },
      })
    });
  </script>
@endpush
