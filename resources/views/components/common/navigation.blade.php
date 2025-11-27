  <header class="absolute left-0 right-0 top-0 z-50 h-16 transition-all duration-300" x-data="{ scrolled: false }">
    <div class="container flex items-center justify-between">
      <div class="flex items-center gap-4">
        @if (request()->routeIs('home.index'))
          <x-common.small-logo
            :src="$logos['white_logo']"
            class="mr-4"
            title="Gate Export SAC"
            url="{{ route('home.index') }}"
          />
        @else
          <x-common.small-logo
            :src="$logos['small_logo']"
            class="mr-4"
            title="Gate Export SAC"
            url="{{ route('home.index') }}"
          />
        @endif

        <nav class="flex h-16 items-center gap-4 font-bold max-lg:hidden">
          @include('partials.nav-link', [
              'path' => 'home.index',
              'text' => __('layouts.navigation.home'),
          ])

          @include('partials.category-menu', [
              'items' => $items,
          ])

          @include('partials.nav-link', [
              'path' => 'about-us.index',
              'text' => __('layouts.navigation.about_us'),
          ])

          @include('partials.nav-link', [
              'path' => 'services.index',
              'text' => __('layouts.navigation.services'),
          ])

          @include('partials.nav-link', [
              'path' => 'articles.index',
              'text' => __('layouts.navigation.articles'),
          ])
        </nav>
      </div>

      <div class="flex items-center gap-4 transition-all duration-300">
        <x-common.locale-switch />
        <livewire:shared.search />
      </div>
    </div>
  </header>
