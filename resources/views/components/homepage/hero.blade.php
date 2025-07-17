@props([
    'promotional_banners' => [],
])

<article class="swiper bg-gray-300">
  <div class="swiper-wrapper">

    @foreach ($promotional_banners as $banner)
      <div class="swiper-slide flex min-h-[400px] items-center justify-center bg-red-500 text-center">
        <img
          alt="{{ $banner['title'] }}"
          class="h-full w-full object-cover"
          src="{{ Storage::disk('public')->url($banner['image']) }}"
        >
        <h3>{{ $banner['title'] }}</h3>
        <p>{{ $banner['short_description'] }}</p>
      </div>
    @endforeach

  </div>
</article>

@push('scripts')
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {

      const swiper = new Swiper('.swiper');
    });
  </script>
@endpush
