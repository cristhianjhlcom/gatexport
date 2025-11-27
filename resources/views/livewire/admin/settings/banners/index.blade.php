@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      Banners Promocionales
    </flux:heading>
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
          icon:trailing="plus"
          size="sm"
          variant="outline"
          wire:click="add('{{ $locale }}')"
        >
          Agregar banner
        </flux:button>

        <span class="text-sm text-gray-500">
          {{ count($banners[$locale]) }} Banner(s) agregado(s)
        </span>

        @if (!empty($banners[$locale]))
          <section class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($banners[$locale] as $index => $banner)
              <flux:card class="space-y-4">
                <flux:textarea
                  badge="Requerido"
                  description="Sera utilizado como el alt de la imagen"
                  label="Título"
                  placeholder="Ej: Sahumerios, Inciensos y Velas"
                  wire:model="banners.{{ $locale }}.{{ $index }}.title"
                />

                {{-- <flux:input
                  badge="Requerido"
                  label="URL"
                  placeholder="/catetories"
                  wire:model="banners.{{ $locale }}.{{ $index }}.link_url"
                /> --}}

                <flux:select
                  badge="Requerido"
                  placeholder="Escoge una URL..."
                  searchable
                  variant="listbox"
                  wire:model="banners.{{ $locale }}.{{ $index }}.link_url"
                >
                  @forelse ($urls as $url)
                    <flux:select.option value="{{ $url['path'] }}" wire:key="{{ $url['id'] }}">
                      {{ $url['label'] }} ({{ $url['id'] }})
                    </flux:select.option>
                  @empty
                    <flux:select.option disabled>No URLs Disponibles</flux:select.option>
                  @endforelse
                </flux:select>

                <flux:input
                  badge="Requerido"
                  label="Position del banner"
                  placeholder="Ej: 1"
                  type="number"
                  wire:model="banners.{{ $locale }}.{{ $index }}.position"
                />

                <div class="space-y-4">
                  <div class="space-y-2 overflow-hidden">
                    @php
                      $imageDesktop = $banner['image_desktop'] ??= '';
                      $hasImageDesktop = empty($imageDesktop);
                      $tmpImageDesktop = $tmp_images_desktop[$locale][$index] ??= null;
                    @endphp

                    <flux:file-upload
                      label="Imagen Desktop"
                      size="sm"
                      wire:model.live="tmp_images_desktop.{{ $locale }}.{{ $index }}"
                    >
                      <flux:file-upload.dropzone
                        :heading="$imageDesktop"
                        inline
                        text="1200x600 - JPG, PNG, Webp hasta 2MB"
                        with-progress
                      />
                    </flux:file-upload>

                    @if ($tmpImageDesktop)
                      <flux:file-item
                        :heading="$tmpImageDesktop->getClientOriginalName()"
                        :image="$tmpImageDesktop->temporaryUrl()"
                        :size="$tmpImageDesktop->getSize()"
                      />
                    @endif
                  </div>

                  <div class="space-y-2 overflow-hidden">
                    @php
                      $imageMobile = $banner['image_mobile'] ??= '';
                      $hasImageMobile = empty($imageMobile);
                      $tmpImageMobile = $tmp_images_mobile[$locale][$index] ??= null;
                    @endphp

                    <flux:file-upload
                      label="Imagen Mobile"
                      size="sm"
                      wire:model.live="tmp_images_mobile.{{ $locale }}.{{ $index }}"
                    >
                      <flux:file-upload.dropzone
                        :heading="$imageMobile"
                        inline
                        text="500x500 - JPG, PNG, Webp hasta 2MB"
                        with-progress
                      />
                    </flux:file-upload>

                    @if ($tmpImageMobile)
                      <flux:file-item
                        :heading="$tmpImageMobile->getClientOriginalName()"
                        :image="$tmpImageMobile->temporaryUrl()"
                        :size="$tmpImageMobile->getSize()"
                      />
                    @endif
                  </div>
                </div>

                <div class="flex justify-end">
                  <flux:button
                    icon:trailing="trash"
                    size="sm"
                    variant="ghost"
                    wire:click="remove('{{ $locale }}', {{ $index }})"
                    wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir."
                  >
                    Eliminar
                  </flux:button>
                </div>
              </flux:card>
            @endforeach
          </section>
        @else
          <flux:card class="space-y-4">
            <flux:heading level="3" size="lg">
              Aun no hay banners cargados
            </flux:heading>
            <flux:description size="xs">
              Agrega un banner para comenzar
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
