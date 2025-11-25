<flux:navlist variant="outline">
  <flux:navlist.item href="{{ route('home.index') }}">
    {{ __('layouts.navigation.home') }}
  </flux:navlist.item>

  <flux:navlist.item href="{{ route('services.index') }}">
    {{ __('layouts.navigation.services') }}
  </flux:navlist.item>

  <flux:navlist.item href="{{ route('about-us.index') }}">
    {{ __('layouts.navigation.about_us') }}
  </flux:navlist.item>

  @foreach ($items as $item)
    <flux:navlist.group
      :expanded="false"
      expandable
      heading="{{ $item['name'][app()->getLocale()] }}"
    >
      @foreach ($item['subcategories'] as $subitem)
        <flux:navlist.item href="{{ route('categories.show', $subitem['slug']) }}">
          {{ $subitem['name'][app()->getLocale()] }}
        </flux:navlist.item>
      @endforeach
    </flux:navlist.group>
  @endforeach
</flux:navlist>
<flux:spacer />
