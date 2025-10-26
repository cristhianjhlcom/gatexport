<flux:card>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $name)
        <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $name)
      @php
        $services = $data[$locale]['services'] ??= [];
      @endphp
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
            {{ count($services) }} servicios agregados
          </span>
        </header>

        @if (!empty($services))
          <flux:accordion class="rounded-sm border border-gray-200 p-4">
            @foreach ($services as $index => $service)
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

                    <flux:input
                      badge="Requerido"
                      label="Sub título"
                      placeholder="Lorem Ipsum.."
                      wire:model="companyServices.{{ $locale }}.{{ $index }}.subtitle"
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

                      @if (isset($service['icon']) && Storage::disk('public')->exists($service['icon']))
                        <div class="mt-3 flex flex-col gap-2">
                          <flux:file-item
                            :image="Storage::disk('public')->url($service['icon'])"
                            :size="1000"
                            {{-- :size="Storage::disk('public')->size($service['icon'])" --}}
                            heading="Icono actual"
                          >
                          </flux:file-item>
                        </div>
                      @endif

                      @if (isset($tmp_icons[$locale][$index]))
                        <div class="mt-3 flex flex-col gap-2">
                          <flux:file-item
                            :heading="$tmp_icons[$locale][$index]->getClientOriginalName()"
                            :image="$tmp_icons[$locale][$index]->temporaryUrl()"
                            :size="$tmp_icons[$locale][$index]->getSize()"
                          />
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
          <div class="w-full space-y-4">
            <flux:heading level="3" size="lg">
              No ha servicios
            </flux:heading>
            <flux:description size="xs">
              Agrega un servicio para empezar
            </flux:description>
          </div>
        @endif
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
