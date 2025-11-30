@php
  $isHomePage = request()->routeIs('home.index');
  $theme = $isHomePage ? 'dark' : 'light';
@endphp

<header
  :class="{
      'bg-primary-400/70 backdrop-blur-md': scrolled,
      'bg-primary-400/50 backdrop-blur-sm': !scrolled,
  }"
  @scroll.window="scrolled = window.scrollY > 10"
  class="bg-primary-400/70 fixed left-0 right-0 top-0 z-50 flex h-16 items-center justify-between border-b border-transparent backdrop-blur-md transition-all duration-300 md:hidden"
  role="Mobile Header"
  x-data="{
      toggle: false,
      scrolled: false
  }"
>
  <div class="flex w-full items-center justify-between px-4">
    <button
      @click="toggle = !toggle"
      class="flex items-center rounded-sm p-2 hover:bg-zinc-100"
      type="button"
    >
      <x-icon.burger class="size-8 text-white" fill="#fff" />
    </button>
    <x-common.large-logo
      src="{{ $logos['large_logo'] }}"
      title="Gate Export SAC"
      url="{{ route('home.index') }}"
    />
    <livewire:shared.search :$theme />
  </div>
  <nav
    @click.away="toggle = false"
    class="fixed bottom-0 top-0 z-50 flex h-dvh w-full flex-col overflow-y-auto bg-white"
    x-cloak
    x-show="toggle"
    x-transition:enter-end="transform translate-x-0"
    x-transition:enter-start="transform -translate-x-full"
    x-transition:enter="transition ease-out duration-300"
    x-transition:leave-end="transform -translate-x-full"
    x-transition:leave-start="transform translate-x-0"
    x-transition:leave="transition ease-in duration-200"
  >
    <div class="border-b border-zinc-200 p-4 font-semibold text-zinc-900">
      <button
        @click="toggle = !toggle"
        class="flex items-center gap-4 rounded-sm hover:bg-zinc-100"
        type="button"
      >
        <x-icon.burger class="size-8 text-zinc-900" fill="#000" />
        <span>Cerrar</span>
      </button>
    </div>

    <a
      class="border-b border-zinc-200 p-4 font-semibold text-zinc-900"
      href="{{ route('home.index') }}"
      title="Home"
    >{{ __('layouts.navigation.home') }}</a>
    <a
      class="text-zinc-90 border-b border-zinc-200 p-4 font-semibold"
      href="{{ route('services.index') }}"
      title="Services"
    >{{ __('layouts.navigation.services') }}</a>
    <a
      class="text-zinc-90 border-b border-zinc-200 p-4 font-semibold"
      href="{{ route('about-us.index') }}"
      title="About Us"
    >{{ __('layouts.navigation.about_us') }}</a>

    @foreach ($items as $item)
      <div class="flex flex-col" x-data="{ expanded: false }">
        <button
          @click="expanded = !expanded"
          class="flex items-center justify-between border-b border-zinc-200 p-4"
          type="button"
        >
          <div class="flex items-center gap-4">
            <img
              alt="{{ $item['name'] }}"
              class="aspect-square size-7 object-contain"
              src="{{ $item['icon_primary'] }}"
            >
            <span class="font-semibold text-zinc-900">{{ $item['name'] }}</span>
          </div>
          <x-icon.chevron-down class="size-6" x-show="!expanded" />
          <x-icon.chevron-up class="size-6" x-show="expanded" />
        </button>
        <div
          class="flex flex-col"
          x-collapse
          x-show="expanded"
        >
          @foreach ($item['subcategories'] as $subitem)
            <a
              class="bg-primary-100 border-primary-100 hover:bg-primary-200 flex items-center gap-4 border-b p-4 pl-10"
              href="{{ $subitem['url'] }}"
              title="{{ $subitem['name'] }}"
            >
              <img
                alt="{{ $subitem['name'] }}"
                class="aspect-square size-7 object-contain"
                src="{{ $subitem['icon_primary'] }}"
              >
              <span>{{ $subitem['name'] }}</span>
            </a>
          @endforeach
          <a
            class="bg-primary-100 border-primary-100 hover:bg-primary-200 flex items-center gap-4 border-b p-4 pl-10"
            href="{{ $item['url'] }}"
            title="{{ $item['name'] }}"
          >
            <img
              alt="{{ $item['name'] }}"
              class="aspect-square size-6 object-contain"
              src="{{ $item['icon_primary'] }}"
            >
            <span>{{ __('pages.product.all') }}</span>
          </a>
        </div>
      </div>
    @endforeach
    <a
      class="text-zinc-90 border-b border-zinc-200 p-4 font-semibold"
      href="{{ route('faqs.index') }}"
      title="{{ __('pages.faqs.title') }}"
    >{{ __('pages.faqs.title') }}</a>
    <a
      class="text-zinc-90 border-b border-zinc-200 p-4 font-semibold"
      href="{{ route('politics.show', 'politica-de-privacidad') }}"
      title="{{ __('pages.policies.privacy.title') }}"
    >{{ __('pages.policies.privacy.title') }}</a>
  </nav>
</header>
