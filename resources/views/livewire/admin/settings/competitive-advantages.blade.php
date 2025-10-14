@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      {{ __('Competitive Advantages') }}
    </flux:heading>
    <flux:description size="xs">
      {{ __('Manage the competitive advantages of your company.') }}
    </flux:description>
  </header>

  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <flux:button
          size="sm"
          variant="outline"
          wire:click="add('{{ $locale }}')"
        >
          {{ __('Add Advantage') }}
        </flux:button>
        <span class="text-sm text-gray-500">
          {{ count($competitiveAdvantages[$locale]) }} {{ __('Advantages') }}
        </span>
        @if (!empty($competitiveAdvantages[$locale]))
          <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($competitiveAdvantages[$locale] as $index => $advantage)
              <flux:card class="space-y-4">
                <flux:input
                  badge="{{ __('Required') }}"
                  label="{{ __('Title') }}"
                  placeholder="Lorem Ipsum.."
                  wire:model="competitiveAdvantages.{{ $locale }}.{{ $index }}.title"
                />

                <flux:editor
                  badge="{{ __('Required') }}"
                  label="{{ __('Description') }}"
                  wire:model="competitiveAdvantages.{{ $locale }}.{{ $index }}.description"
                />

                <flux:field>
                  <div class="space-y-4">
                    <flux:label badge="{{ __('Required') }}">{{ __('Image') }}</flux:label>

                    @if (!empty($advantage['image']) && is_string($advantage['image']))
                      <img
                        alt="Current Image"
                        class="aspect-square h-28 w-28 object-cover"
                        src="{{ Storage::disk('public')->url($advantage['image']) }}"
                      />
                    @endif

                    <flux:description size="xs">
                      Imagenes recomendadas: 400x400 / 1000x1000 pixels. Formatos: JPG, PNG, WebP. Máximo: 2MB.
                    </flux:description>

                    <flux:input
                      size="sm"
                      type="file"
                      wire:model="tmp_images.{{ $locale }}.{{ $index }}.image"
                    />

                    <div wire:loading
                      wire:target="competitiveAdvantages.{{ $locale }}.{{ $index }}.image"
                    >
                      <flux:icon.loading />
                    </div>

                    @if (isset($tmp_images[$locale][$index]) && method_exists($tmp_images[$locale][$index], 'temporaryUrl'))
                      <small>Preview</small>
                      <img
                        alt="Image Preview"
                        class="aspect-square h-28 w-28 object-cover"
                        src="{{ $tmp_images[$locale][$index]->temporaryUrl() }}"
                      />
                    @endif

                    <flux:error name="tmp_images.{{ $locale }}.{{ $index }}" />
                    <flux:error name="competitiveAdvantages.{{ $locale }}.{{ $index }}.image" />
                  </div>
                </flux:field>

                <div class="flex justify-end">
                  <flux:button
                    class="absolute right-0 top-0 z-10"
                    icon:trailing="x-mark"
                    size="sm"
                    variant="danger"
                    wire:click="remove('{{ $locale }}', {{ $index }})"
                    wire:confirm="{{ __('Are you sure you want to delete this advantage?') }}"
                  >
                    Eliminar
                  </flux:button>
                </div>
              </flux:card>
            @endforeach
          </section>
        @else
          <flux:card class="max-w-4/12 space-y-4">
            <flux:heading level="3" size="lg">
              {{ __('No Advantages') }}
            </flux:heading>
            <flux:description size="xs">
              {{ __('Add a competitive advantage to get started.') }}
            </flux:description>
          </flux:card>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>


  <div class="fixed bottom-0 w-full bg-white/75 py-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
