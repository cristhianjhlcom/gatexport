@php
  $isHomePage = request()->routeIs('home.index');
  $theme = 'light';
@endphp

<header
  :class="{
      'opacity-0 -translate-y-full': hasScrolled,
      'opacity-100 translate-y-0': !hasScrolled
  }"
  @scroll.window="handleScroll"
  class="z-100 fixed left-0 top-0 hidden h-16 w-full bg-white/80 backdrop-blur-2xl transition-all md:block"
  x-cloak
  x-data="{
      open: false,
      hasScrolled: false,
      threshold: 120,
      handleScroll() {
          this.hasScrolled = this.open || window.scrollY <= this.threshold;
      },
      toggleMenu() {
          this.open = !this.open
      },
      scrollTo(id, contentType = null) {
          window.location.hash = id

          window.scrollTo({
              top: document.querySelector(id).offsetTop - 120,
              behavior: 'smooth',
          })

          if (contentType) {
              this.$dispatch('set-content-type', {
                  case: contentType,
                  override: true,
              })
          }

          this.open = false
      },
  }"
  x-init="handleScroll()"
  x-trap.noscroll="open"
>
  <div class="container flex items-center justify-between">
    <div class="flex items-center gap-4">
      <x-common.small-logo
        :src="$logos['small_logo']"
        class="mr-4"
        title="Gate Export SAC"
        url="{{ route('home.index') }}"
      />

      <nav class="flex h-16 items-center gap-4 font-bold max-lg:hidden">
        @include('partials.nav-link', [
            'path' => 'home.index',
            'text' => __('layouts.navigation.home'),
            'theme' => $theme,
        ])

        @include('partials.category-menu', [
            'items' => $items,
        ])

        @include('partials.nav-link', [
            'path' => 'about-us.index',
            'text' => __('layouts.navigation.about_us'),
            'theme' => $theme,
        ])

        @include('partials.nav-link', [
            'path' => 'services.index',
            'text' => __('layouts.navigation.services'),
            'theme' => $theme,
        ])

        @include('partials.nav-link', [
            'path' => 'articles.index',
            'text' => __('layouts.navigation.articles'),
            'theme' => $theme,
        ])
      </nav>
    </div>

    <div class="flex h-16 items-center gap-4 transition-all duration-300">
      <x-common.locale-switch :$theme />
      <livewire:shared.search :$theme />
    </div>
  </div>
</header>
