@php
  $data = $about['translations']['values'];
  $items = $data['items'];
  $mission = $data['mission'];
  $vision = $data['vision'];
@endphp

<section class="bg-primary-50 dark:bg-primary-50 py-10 md:py-20">
  <div class="container">
    <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
      <div class="border-primary-300 border-3 flex flex-col space-y-4 rounded-xl bg-white p-6 md:space-y-10 md:p-10">
        <header class="text-primary-500 flex flex-col items-center justify-center gap-2 md:gap-4">
          <h3 class="text-2xl font-extrabold capitalize leading-tight md:text-3xl">{{ __('pages.about.values') }}</h3>
          <x-common.separator-line
            class="w-[80%] max-w-[600px]"
            color="border-primary-500"
            pointColor="bg-primary-500"
          />
        </header>

        <div class="space-y-4">
          @foreach ($items as $item)
            <div class="flex items-center gap-4 text-gray-900 dark:text-gray-900">
              <div>💪🏽</div>
              <div class="text-sm leading-relaxed md:text-base">{!! $item['description'] !!}</div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="grid-cols1 grid grid-rows-2 gap-4">
        <div
          class="border-primary-300 border-3 flex flex-col space-y-4 rounded-xl bg-white p-6 text-left md:space-y-10 md:p-10 md:text-center"
        >
          <header class="text-primary-500 flex flex-col items-center justify-center gap-2 md:gap-4">
            <h3 class="text-2xl font-extrabold capitalize leading-tight md:text-3xl">{{ $mission['title'] }}</h3>
            <x-common.separator-line
              class="w-[80%] max-w-[600px]"
              color="border-primary-500"
              pointColor="bg-primary-500"
            />
          </header>
          <div class="space-y-2 text-sm leading-relaxed text-gray-900 md:text-base dark:text-gray-900">
            {!! $mission['description'] !!}
          </div>
        </div>
        <div
          class="border-primary-300 border-3 flex flex-col space-y-4 rounded-xl bg-white p-6 text-left md:p-10 md:text-center"
        >
          <header class="text-primary-500 flex flex-col items-center justify-center gap-2 md:gap-4">
            <h3 class="text-2xl font-extrabold capitalize leading-tight md:text-3xl">{{ $vision['title'] }}</h3>
            <x-common.separator-line
              class="w-[80%] max-w-[600px]"
              color="border-primary-500"
              pointColor="bg-primary-500"
            />
          </header>
          <div class="space-y-2 text-sm leading-relaxed text-gray-900 md:text-base dark:text-gray-900">
            {!! $vision['description'] !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
