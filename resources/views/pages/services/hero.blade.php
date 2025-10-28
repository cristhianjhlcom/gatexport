<section class="w-full bg-cover bg-center py-10 md:py-20"
  style="background-image: url({{ Storage::disk('public')->url($hero['image']) }})"
>
  <div class="container text-center text-white">
    <div class="mx-auto w-full max-w-2xl space-y-6">
      <header class="space-y-2">
        @if ($hero['title'])
          @php
            $headingParts = explode(' ', $hero['title']);
            $limit = 3;
            $class = 'text-white dark:text-white text-2xl font-extrabold leading-tight md:text-3xl';
          @endphp

          @if (count($headingParts) > $limit)
            <h1 class="{{ $class }}">{{ implode(' ', array_slice($headingParts, 0, $limit)) }}</h1>
            <x-common.separator-line
              class="w-full"
              color="border-white"
              pointColor="bg-white"
            />
            <h1 class="{{ $class }}">{{ implode(' ', array_slice($headingParts, 3)) }}</h1>
          @else
            <h1 class="{{ $class }}">{{ $hero['title'] }}</h1>
          @endif
        @endif
      </header>
      <div class="md:text-md space-y-4 text-sm leading-relaxed">{!! $hero['description'] !!}</div>
    </div>
  </div>
</section>
