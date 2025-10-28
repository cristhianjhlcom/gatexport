<section class="w-full bg-cover bg-center py-10 md:py-20"
  style="background-image: url({{ Storage::disk('public')->url($hero['image']) }})"
>
  <div class="container text-center text-white">
    <div class="mx-auto w-full max-w-2xl space-y-6">
      <header class="space-y-2">
        @if ($hero['title'])
          @php
            $headingParts = explode(' ', $hero['title']);
          @endphp

          @if (count($headingParts) > 3)
            <h1 class="text-2xl font-extrabold leading-tight text-white md:text-3xl dark:text-white">
              {{ implode(' ', array_slice($headingParts, 0, 3)) }}
            </h1>
            <x-common.separator-line
              class="w-full"
              color="border-white"
              pointColor="bg-white"
            />
            <h1 class="m-0 text-2xl font-extrabold leading-tight text-white md:text-3xl dark:text-white">
              {{ implode(' ', array_slice($headingParts, 3)) }}
            </h1>
          @else
            <h1 class="text-2xl font-extrabold italic leading-tight text-white md:text-3xl dark:text-white">
              {{ $hero['title'] }}
            </h1>
          @endif
        @endif
      </header>
      <div class="space-y-4 leading-relaxed">{!! $hero['description'] !!}</div>
    </div>
  </div>
</section>
