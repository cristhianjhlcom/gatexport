<article class="bg-primary-50 py-10 md:py-16 lg:py-20">
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

@push('styles')
  <style>
    .jvm-container {
      background-color: transparent !important;
    }
  </style>
@endpush

@push('scripts')
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      const selectedRegions = [
        'US', 'CR', 'PE', 'AR', 'UY', 'BR', 'CA', 'MX', 'BZ', 'CO',
        'GT', 'VE', 'DO', 'SV', 'CL', 'PA', 'JM', 'EG', 'ZA', 'AU',
        'NZ', 'KR', 'ID', 'JP', 'IN', 'TW', 'HK', 'PK', 'MY', 'SG',
        'CN', 'TR', 'VN', 'IL', 'AE', 'KZ', 'PH', 'AM', 'TH', 'JO',
        'LB', 'NL', 'RU', 'DE', 'GB', 'CZ', 'FR', 'ES', 'SE', 'PL',
        'LT', 'CH', 'IT', 'SI', 'EE', 'LV', 'IE', 'UA', 'GE', 'PT',
        'BG', 'BE'
      ];

      const map = new jsVectorMap({
        selector: '#map',
        map: 'world',
        selectedRegions,
        backgroundColor: '#ffffff',
        zoomOnScroll: false,
        zoomOnScrollSpeed: 0.5,
        regionLabelStyle: {
          initial: {
            fill: '#ff0000', // accent color for labels
          },
        },
        regionStyle: {
          initial: {
            fill: '#e4e4e4',
            // stroke: '#fff',
            'stroke-width': 1,
          },
          selected: {
            fill: '#ed7d31',
          },
        },
        responsive: true,
        onRegionClick: (region) => {},
      })
    });
  </script>
@endpush
