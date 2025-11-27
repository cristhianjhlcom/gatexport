<div class="relative" x-data="{ localeOpen: false }">
  <!-- Botón trigger -->
  <button
    :class="{ 'bg-gray-100': localeOpen }"
    @click="localeOpen = !localeOpen"
    class="flex items-center gap-2 rounded-lg p-2 transition-colors duration-200 hover:bg-zinc-100"
  >
    <img
      alt="{{ app()->getLocale() === 'es' ? 'Español' : 'English' }}"
      class="aspect-square size-6 rounded-sm object-contain"
      src="{{ app()->getLocale() === 'es' ? asset('storage/uploads/settings/flags/peru_flag.png') : asset('storage/uploads/settings/flags/united_states_flag.png') }}"
    >
    <span @class([
        'text-white!' => request()->routeIs('home.index'),
        'text-sm font-semibold leading-none text-white md:text-zinc-900',
    ])>{{ app()->getLocale() }}</span>
    {{-- <x-icon.chevron-down class="size-4 text-zinc-900" x-show="!localeOpen" />
    <x-icon.chevron-up class="size-4 text-zinc-900" x-show="localeOpen" /> --}}
  </button>

  <!-- Dropdown menu -->
  <div
    @click.away="localeOpen = false"
    class="absolute right-0 z-50 mt-2 w-48 rounded-lg border border-gray-200 bg-white py-2 shadow-xl"
    x-cloak
    x-show="localeOpen"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter="transition ease-out duration-200"
    x-transition:leave-end="opacity-0 scale-95"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
  >
    <!-- Opción Español -->
    @foreach (config('localization.locales') as $locale)
      <a class="flex items-center gap-3 px-4 py-2 text-sm transition-colors duration-200 hover:bg-gray-50"
        href="{{ route('localization.update', $locale) }}"
      >
        <img
          alt="{{ $locale === 'es' ? 'Español' : 'English' }}"
          class="aspect-square size-4 rounded-sm object-contain"
          src="{{ $locale === 'es' ? Storage::disk('public')->url('uploads/settings/flags/peru_flag.png') : Storage::disk('public')->url('uploads/settings/flags/united_states_flag.png') }}"
        >
        <span class="flex-1 font-semibold">{{ __("layouts.navigation.{$locale}") }}</span>
      </a>
    @endforeach
  </div>
</div>
