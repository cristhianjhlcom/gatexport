<article class="py-10 md:py-16 lg:py-20">
  <div class="container">
    <h2 class="mb-8 text-center text-3xl font-bold md:mb-12 md:text-4xl">
      Nuestros Países y Regiones de Exportación
    </h2>
    <div id="map" style="height: 750px; width: 100%;"></div>
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
