@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">
      Servicios de la Empresa
    </flux:heading>
  </header>

  <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2">
    <flux:tab.group>
      <flux:tabs variant="segmented">
        @foreach ($locales as $locale => $name)
          <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
        @endforeach
      </flux:tabs>

      @foreach ($locales as $locale => $name)
        <flux:tab.panel class="space-y-4" name="{{ $locale }}">
          <flux:card class="space-y-2">
            <flux:input
              label="Título principal"
              placeholder="Ej: servicio principal"
              wire:model="companyServices.heading"
            />
            <flux:textarea
              label="Descripción del servicio"
              placeholder="Ej: descripción de la sección"
              wire:model="companyServices.description"
            />
            <flux:textarea
              label="Mensaje importante"
              placeholder="Ej: lorem ipsum"
              wire:model="companyServices.important_message"
            />
            <flux:textarea
              label="Observación"
              placeholder="Ej: lorem ipsum"
              wire:model="companyServices.disclaimer"
            />
            <div>
              {{-- Input of the main image --}}
              <flux:file-upload label="Imagen Principal" wire:model="newMainImage">
                <flux:file-upload.dropzone heading="Drop file here or click to browse"
                  text="JPG, PNG, GIF up to 10MB" />
              </flux:file-upload>

              @if (Storage::disk('public')->exists($companyServices['main_image']))
                <div class="mt-3 flex flex-col gap-2">
                  <flux:file-item
                    :image="Storage::disk('public')->url($companyServices['main_image'])"
                    :size="1000"
                    {{-- :size="Storage::disk('public')->size($service['icon'])" --}}
                    heading="Imagen Principal Actual"
                  >
                    {{--
                        <x-slot name="actions">
                        <flux:file-item.remove aria-label="{{ 'Remove file: ' . $newMainImage->getClientOriginalName() }}" wire:click="removePhoto" />
                        </x-slot>
                        --}}
                  </flux:file-item>
                </div>
              @endif

              @if ($newMainImage)
                <div class="mt-3 flex flex-col gap-2">
                  <flux:file-item
                    :heading="$newMainImage->getClientOriginalName()"
                    :image="$newMainImage->temporaryUrl()"
                    :size="$newMainImage->getSize()"
                  >
                    {{--
                    <x-slot name="actions">
                    <flux:file-item.remove aria-label="{{ 'Remove file: ' . $newMainImage->getClientOriginalName() }}" wire:click="removePhoto" />
                    </x-slot>
                    --}}
                  </flux:file-item>
                </div>
              @endif

            </div>
          </flux:card>
        </flux:tab.panel>
      @endforeach
    </flux:tab.group>

    <flux:tab.group>
      <flux:tabs variant="segmented">
        @foreach ($locales as $locale => $name)
          <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
        @endforeach
      </flux:tabs>

      @foreach ($locales as $locale => $name)
        <flux:tab.panel class="space-y-4" name="{{ $locale }}">
          <header class="rounded-sm border border-gray-200 p-4">
            <flux:button
              icon:trailing="plus"
              size="sm"
              variant="outline"
              wire:click="add('{{ $locale }}')"
            >
              Agregar servicio
            </flux:button>

            <span class="text-sm text-gray-500">
              {{ count($companyServices[$locale]) }} servicios agregados
            </span>
          </header>

          @if (!empty($companyServices[$locale]))
            <flux:accordion class="rounded-sm border border-gray-200 p-4">
              @foreach ($companyServices[$locale] as $index => $service)
                <flux:accordion.item :expanded="$loop->first">
                  <flux:accordion.heading>({{ $index + 1 }}) {{ $service['title'] }}</flux:accordion.heading>
                  <flux:accordion.content>
                    <div class="space-y-4 pt-4">
                      <flux:input
                        badge="Requerido"
                        label="Título"
                        placeholder="Lorem Ipsum.."
                        wire:model="companyServices.{{ $locale }}.{{ $index }}.title"
                      />

                      <flux:editor
                        badge="Requerido"
                        label="Descripción"
                        wire:model="companyServices.{{ $locale }}.{{ $index }}.description"
                      />

                      <div>
                        {{-- Input of the main image --}}
                        <flux:file-upload label="Icono del servicio"
                          wire:model="tmpIcons.{{ $locale }}.{{ $index }}"
                        >
                          <flux:file-upload.dropzone
                            heading="Drop file here or click to browse"
                            inline
                            text="JPG, PNG, WebP o SVG - 2MB"
                            with-progress
                          />
                        </flux:file-upload>

                        @if (Storage::disk('public')->exists($service['icon']))
                          <div class="mt-3 flex flex-col gap-2">
                            <flux:file-item
                              :image="Storage::disk('public')->url($service['icon'])"
                              :size="1000"
                              {{-- :size="Storage::disk('public')->size($service['icon'])" --}}
                              heading="Icono actual"
                            >
                              {{--
                        <x-slot name="actions">
                        <flux:file-item.remove aria-label="{{ 'Remove file: ' . $newMainImage->getClientOriginalName() }}" wire:click="removePhoto" />
                        </x-slot>
                        --}}
                            </flux:file-item>
                          </div>
                        @endif

                        @if (isset($tmp_icons[$locale][$index]))
                          <div class="mt-3 flex flex-col gap-2">
                            <flux:file-item
                              :heading="$tmp_icons[$locale][$index]->getClientOriginalName()"
                              :image="$tmp_icons[$locale][$index]->temporaryUrl()"
                              :size="$tmp_icons[$locale][$index]->getSize()"
                            >
                              {{--
                        <x-slot name="actions">
                        <flux:file-item.remove aria-label="{{ 'Remove file: ' . $newMainImage->getClientOriginalName() }}" wire:click="removePhoto" />
                        </x-slot>
                        --}}
                            </flux:file-item>
                          </div>
                        @endif
                      </div>

                      <div class="flex justify-end">
                        <flux:button
                          class="absolute right-0 top-0 z-10"
                          icon:trailing="x-mark"
                          size="sm"
                          variant="danger"
                          wire:click="remove('{{ $locale }}', {{ $index }})"
                          wire:confim="Estas seguro de eliminar este servicio?"
                        >
                          Eliminar
                        </flux:button>
                      </div>
                    </div>
                  </flux:accordion.content>
                </flux:accordion.item>
              @endforeach
            </flux:accordion>
          @else
            <flux:card class="max-w-4/12 space-y-4">
              <flux:heading level="3" size="lg">
                No ha servicios
              </flux:heading>
              <flux:description size="xs">
                Agrega un servicio para empezar
              </flux:description>
            </flux:card>
          @endif
        </flux:tab.panel>
      @endforeach
    </flux:tab.group>
  </div>
  {{-- #End Input of the main image --}}

  <div class="fixed bottom-0 w-full border-t border-gray-200 bg-white/75 p-2">
    <flux:button type="submit" variant="primary">
      Guardar configuración
    </flux:button>
  </div>
</form>
