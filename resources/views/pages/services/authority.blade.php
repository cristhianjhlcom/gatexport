<section class="w-full bg-white py-10">
  <div class="container">
    <header class="mx-auto max-w-5xl space-y-2 text-center">
      @if ($authority['content'])
        @php
          $headingParts = explode(' ', $authority['content']);
          $limit = 11;
          $class = 'text-primary-500 dark:text-primary-500 text-md font-extrabold leading-relaxed md:text-2xl';
        @endphp

        @if (count($headingParts) > $limit)
          <h2 class="{{ $class }}">{{ implode(' ', array_slice($headingParts, 0, $limit)) }}</h2>
          <x-common.separator-line
            class="w-full"
            color="border-primary-500"
            pointColor="bg-primary-500"
          />
          <h2 class="{{ $class }}">{{ implode(' ', array_slice($headingParts, $limit)) }}</h2>
        @else
          <h2 class="{{ $class }}">{{ $authority['content'] }}</h2>
        @endif
      @endif
    </header>
  </div>
</section>
