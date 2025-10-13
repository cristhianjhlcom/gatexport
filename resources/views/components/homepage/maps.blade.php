@props([
    'export_continents' => [],
])

<article class="bg-white py-10 md:py-16 lg:py-20">
  <div
    class="container space-y-6"
    continents="{{ json_encode($export_continents) }}"
    id="continents-maps"
  >
    <x-heading
      class="text-center"
      level="2"
      size="xl"
      weight="black"
    >
      {{ __('pages.home.countries_exports.title') }}
    </x-heading>
    <div class="swiper-container-countries">
      <div class="swiper-wrapper overflow-hidden">
        @foreach ($export_continents as $continent)
          <div class="swiper-slide">
            <h2 class="text-center">{{ $continent['name'] }}</h2>
            <div
              {{-- class="md:!h-[750px]" --}}
              {{-- style="height: 170px; width: 100%;" --}}
              class="map-container"
              id="map-{{ $continent['id'] }}"
            ></div>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</article>

@push('styles')
  <style>
    .jvm-container {
      background-color: transparent !important;
    }

    .swiper-container-countries {
      width: 100%;
      height: 750px;
      /* Altura fija para el carrusel en desktop */
    }

    .map-container {
      width: 100%;
      height: 100%;
      /* El mapa ocupará toda la altura del slide */
    }

    /* Estilos para los botones de navegación */
    .swiper-button-next,
    .swiper-button-prev {
      color: #ed7d31;
      /* Color de acento para las flechas */
    }

    /* Estilos para la paginación */
    .swiper-pagination-bullet-active {
      background-color: #ed7d31;
      /* Color de acento para el punto activo */
    }
  </style>
@endpush

@push('scripts')
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      function initializeMap(containerId, selectedRegions) {
        new jsVectorMap({
          selector: `#${containerId}`,
          map: 'world',
          selectedRegions,
          backgroundColor: '#ffffff',
          zoomOnScroll: false,
          zoomOnScrollSpeed: 0.5,
          zoomButtons: false,
          //   focusOn: {
          //     regions: selectedRegions,
          //     animate: true,
          //   },
          regionLabelStyle: {
            initial: {
              fill: '#ff0000', // accent color for labels
            },
          },
          regionStyle: {
            initial: {
              fill: '#fce8de',
              stroke: 'transparent',
              strokeWidth: 1.5,
            },
            selected: {
              fill: '#dc801e',
            },
            selectedHover: {
              fill: '#923d10'
            },
          },
          responsive: true,
          onRegionClick: (region) => {},
        });
      }

      const swiper = new Swiper('.swiper-container-countries', {
        delay: 5000,
        autoplay: false,
        disableOnInteraction: true,
        loop: false,
        on: {
          init: function() {
            // Initialize maps for each slide on Swiper init
            const continentsMapsId = document.querySelector('#continents-maps');
            const continentsData = JSON.parse(continentsMapsId.getAttribute('continents'));
            continentsData.forEach(continent => {
              const selectedRegions = continent.countries.map(country => country.code);
              initializeMap(`map-${continent.id}`, selectedRegions);
            });
          },
          slideChange: function() {
            // Re-initialize maps if needed on slide change (optional, depending on map library behavior)
            // const continentsData = JSON.parse(document.querySelector('.container').getAttribute('continents'));
            // const currentContinent = continentsData[this.realIndex];
            // const selectedRegions = currentContinent.countries.map(country => country.code);
            // initializeMap(`map-${currentContinent.id}`, selectedRegions);
          }
        }
      });

    });
  </script>
@endpush
