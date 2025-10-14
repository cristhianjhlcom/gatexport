@props([
    'export_continents' => [],
])

<article class="relative bg-white py-10 md:py-16 lg:py-20">
  <div
    class="container space-y-6"
    continents="{{ json_encode(['continents' => $export_continents, 'selectedContinent' => []]) }}"
    id="continents-maps"
  >
    <header class="flex flex-col space-y-4">
      <x-common.title
        class="text-center"
        level="2"
        size="title"
        variant="primary"
        weight="font-extrabold"
      >
        {{ __('pages.home.countries_exports.title') }}
      </x-common.title>
      <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
    </header>
    <div class="swiper-container-countries relative overflow-hidden">
      <div class="swiper-wrapper">
        @foreach ($export_continents as $continent)
          <div class="swiper-slide relative" data-continent-id="{{ $continent['id'] }}">

            <div class="pointer-events-none absolute bottom-0 flex flex-col items-center justify-center">
              <p class="text-primary-200 text-left text-3xl font-extrabold md:text-6xl lg:text-9xl">
                {{ strtoupper($continent['name']) }}
              </p>
            </div>

            <div class="relative flex flex-col space-y-4">
              <div class="absolute right-10 top-20 z-20">
                <h2 class="text-primary-500 text-5xl font-extrabold uppercase md:text-7xl">
                  {{ $continent['name'] }}
                </h2>
                <x-common.separator-line class="mx-auto w-full max-w-[500px]" />
              </div>

              <ul class="grid-rows-15 z-10 hidden auto-cols-max grid-flow-col gap-x-10 gap-y-2 md:grid md:p-4">
                @foreach ($continent['countries'] as $country)
                  <li class="flex items-center gap-x-4 text-sm font-normal italic text-gray-900 md:text-2xl">
                    <span class="text-primary-500 text-2xl">
                      &#10148;
                    </span>
                    {{ $country['name'] }}
                  </li>
                @endforeach
              </ul>

            </div>
            <div class="map-container" id="map-{{ $continent['id'] }}"></div>
          </div>
        @endforeach
      </div>

    </div>

  </div>

  <div class="swiper-navigation-buttons md:right-1/6 absolute bottom-0 right-0 z-30 flex space-x-4 p-4">
    <div class="swiper-button-prev-custom bg-primary-500 rounded-full p-2 text-white">
      <svg
        class="size-6"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          clip-rule="evenodd"
          d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
          fill-rule="evenodd"
        />
      </svg>
    </div>
    <div class="swiper-button-next-custom bg-primary-500 rounded-full p-2 text-white">
      <svg
        class="size-6"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          clip-rule="evenodd"
          d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
          fill-rule="evenodd"
        />
      </svg>
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
    }

    .map-container {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 5;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #ed7d31;
      z-index: 30;
    }

    .swiper-pagination-bullet-active {
      background-color: #ed7d31;
    }

    .country-bullet {
      font-size: 1.2rem;
      line-height: 1;
    }

    .continent-title {
      letter-spacing: 0.2em;
    }

    .continent-title-separator {
      width: 80px;
      margin-top: 10px;
    }

    @media (max-width: 768px) {
      .continent-background-text {
        display: none;
      }

      .list-countries {
        position: static;
        margin-left: 0;
        max-width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      }

      .list-countries>li {
        width: 100%;
      }
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
          backgroundColor: 'transparent',
          zoomOnScroll: false,
          zoomOnScrollSpeed: 1.0,
          zoomButtons: false,
          regionsSelectable: false,
          showTooltip: false,
          focusOn: {
            regions: selectedRegions,
            animate: true,
          },
          regionStyle: {
            initial: {
              fill: '#fce8de',
              stroke: 'transparent',
              strokeWidth: 0.5,
            },
            selected: {
              fill: '#f5b191',
            },
            selectedHover: {
              fill: '#923d10'
            },
          },
          responsive: true,
          onRegionClick: (region) => {},
          onRegionTooltipShow(event, tooltip) {
            tooltip.css({
              backgroundColor: '#923d10',
              zIndex: 10,
            })
          },
        });
      }

      const swiper = new Swiper('.swiper-container-countries', {
        delay: 10000, // 10 segundos.
        autoplay: true,
        disableOnInteraction: true,
        loop: true,
        slidesPerView: 1,
        navigation: {
          nextEl: '.swiper-button-next-custom',
          prevEl: '.swiper-button-prev-custom',
        },
        on: {
          init: function() {
            const continentsMapsId = document.querySelector('#continents-maps');
            const continentsData = JSON.parse(continentsMapsId.getAttribute('continents'));
            const initialContinent = continentsData.continents[this.realIndex];
            const selectedRegions = initialContinent.countries.map(country => country.code);

            initializeMap(`map-${initialContinent.id}`, selectedRegions);
          },
          slideChange: function() {
            const continentsMapsId = document.querySelector('#continents-maps');
            const continentsData = JSON.parse(continentsMapsId.getAttribute('continents'));
            const currentContinent = continentsData.continents[this.realIndex];
            const selectedRegions = currentContinent.countries.map(country => country.code);

            initializeMap(`map-${currentContinent.id}`, selectedRegions);
          }
        }
      });

    });
  </script>
@endpush
