@php
  $data = $about['translations']['values'];
  $items = $data['items'];
  $mission = $data['mission'];
  $vision = $data['vision'];
@endphp

<section class="bg-primary-50 py-20">
  <div class="container">
    <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
      <div
        class="rounded-4xl border-primary-300 border-3 flex flex-col items-center justify-center space-y-10 bg-white p-10"
      >
        <header class="text-primary-500 flex flex-col items-center justify-center gap-4">
          <h3 class="text-3xl font-extrabold capitalize leading-tight">{{ __('pages.about.values') }}</h3>
          <x-common.separator-line
            class="w-full"
            color="border-primary-500"
            pointColor="bg-primary-500"
          />
        </header>

        <div class="space-y-4">
          @foreach ($items as $item)
            <div class="flex items-center gap-4">
              <div>💪🏽</div>
              <div>{!! $item['description'] !!}</div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="grid-cols1 grid grid-rows-2 gap-4">
        <div
          class="rounded-4xl border-primary-300 border-3 flex flex-col items-center justify-center space-y-10 bg-white p-10 text-center"
        >
          <header class="text-primary-500 flex flex-col items-center justify-center gap-4">
            <h3 class="text-3xl font-extrabold capitalize leading-tight">{{ $mission['title'] }}</h3>
            <x-common.separator-line
              class="w-full max-w-[800px]"
              color="border-primary-500"
              pointColor="bg-primary-500"
            />
          </header>
          <div>{!! $mission['description'] !!}</div>
        </div>
        <div
          class="rounded-4xl border-primary-300 border-3 flex flex-col items-center justify-center space-y-4 bg-white p-10 text-center"
        >
          <header class="text-primary-500 flex flex-col items-center justify-center gap-4">
            <h3 class="text-3xl font-extrabold capitalize leading-tight">{{ $vision['title'] }}</h3>
            <x-common.separator-line
              class="w-full max-w-[800px]"
              color="border-primary-500"
              pointColor="bg-primary-500"
            />
          </header>
          <div>{!! $vision['description'] !!}</div>
        </div>
      </div>
    </div>
  </div>
</section>
