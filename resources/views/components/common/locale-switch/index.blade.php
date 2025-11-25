<div class="hidden md:block">
  <flux:dropdown align="start" position="top">
    @if (app()->getLocale() === 'es')
      <flux:profile avatar="{{ Storage::disk('public')->url('uploads/settings/flags/peru_flag.png') }}" />
    @else
      <flux:profile avatar="{{ Storage::disk('public')->url('uploads/settings/flags/united_states_flag.png') }}" />
    @endif
    <flux:navmenu>
      @foreach (config('localization.locales') as $locale)
        <flux:navmenu.item href="{{ route('localization.update', $locale) }}">
          {{ __("layouts.navigation.{$locale}") }}
        </flux:navmenu.item>
      @endforeach
    </flux:navmenu>
  </flux:dropdown>
</div>
