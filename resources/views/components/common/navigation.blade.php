<nav class="flex h-16 items-center gap-4 text-gray-900 max-lg:hidden">
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
</nav>
