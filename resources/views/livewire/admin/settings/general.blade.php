@php
  $locales = [
      'es' => 'Spanish',
      'en' => 'English',
  ];
@endphp

<form class="space-y-6" wire:submit.prevent="save">
  <header>
    <flux:heading level="2" size="lg">General Information</flux:heading>
  </header>
  <section class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="space-y-6">
      {{-- General Information --}}
      <flux:card class="space-y-4">
        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>

          @foreach ($locales as $locale => $name)
            <flux:tab.panel class="space-y-4" name="{{ $locale }}">
              <div class="space-y-4">
                <flux:input
                  badge="Required"
                  label="Nombre de la Empresa"
                  placeholder="Gate Export"
                  wire:model="general_info.{{ $locale }}.company_name"
                />

                <flux:textarea
                  badge="Required"
                  label="Descripción Corta"
                  placeholder="Lorem Ipsum..."
                  wire:model="general_info.{{ $locale }}.company_short_description"
                />

                <flux:editor
                  badge="Required"
                  label="Descripción Completa"
                  placeholder="Lorem Ipsum..."
                  wire:model="general_info.{{ $locale }}.company_description"
                />
              </div>
            </flux:tab.panel>
          @endforeach

        </flux:tab.group>
      </flux:card>
      {{-- #End General Information --}}

      {{-- Highlighted Categories --}}
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            Categorías Destacadas
          </flux:heading>
          <flux:description size="xs">
            Maneja las categorías destacadas para la página principal
          </flux:description>
          <flux:separator />
        </header>

        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>

          @foreach ($locales as $locale => $name)
            <flux:tab.panel class="space-y-4" name="{{ $locale }}">
              <header>
                <flux:button
                  icon:trailing="plus"
                  size="sm"
                  type="button"
                  variant="outline"
                  wire:click="addCategory('{{ $locale }}')"
                >
                  Agregar categoría
                </flux:button>
                <span class="text-sm text-gray-500">
                  {{ count($highlighted_categories[$locale]) }} Categoria(s) agregada(s)
                </span>
              </header>

              @if (!empty($highlighted_categories[$locale]))
                @foreach ($highlighted_categories[$locale] as $index => $category)
                  <div class="flex flex-col space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                      <flux:input
                        label="Title"
                        placeholder="Category Title"
                        wire:model="highlighted_categories.{{ $locale }}.{{ $index }}.title"
                      />

                      <flux:input
                        label="URL"
                        placeholder="https://example.com"
                        wire:model="highlighted_categories.{{ $locale }}.{{ $index }}.url"
                      />
                    </div>

                    <div>
                      @if (
                          !empty($tmp_highlighted_category_images[$locale][$index]) &&
                              is_string($tmp_highlighted_category_images[$locale][$index]))
                        <img
                          alt="Image Preview"
                          class="object-contain"
                          src="{{ Storage::disk('public')->url($tmp_highlighted_category_images[$locale][$index]) }}"
                        />
                      @elseif (isset($tmp_images_mobile[$locale][$index]) &&
                              is_object($tmp_images_mobile[$locale][$index]) &&
                              method_exists($tmp_highlighted_category_images[$locale][$index], 'temporaryUrl'))
                        <img
                          alt="Image Preview"
                          class="object-contain"
                          src="{{ $tmp_highlighted_category_images[$locale][$index]->temporaryUrl() }}"
                        />
                      @endif

                      <flux:input type="file"
                        wire:model="tmp_highlighted_category_images.{{ $locale }}.{{ $index }}"
                      />
                      <div wire:loading
                        wire:target="tmp_highlighted_category_images.{{ $locale }}.{{ $index }}"
                      >
                        <flux:icon.loading />
                      </div>
                      <flux:error name="tmp_highlighted_category_images.{{ $locale }}.{{ $index }}" />
                    </div>

                    <div class="flex justify-end">
                      <flux:button
                        icon:trailing="x-mark"
                        type="button"
                        variant="danger"
                        wire:click="removeCategory('{{ $locale }}', {{ $index }})"
                      >
                        Eliminar
                      </flux:button>
                    </div>
                  </div>
                @endforeach
              @else
                <flux:card class="space-y-4">
                  <flux:heading level="3" size="lg">
                    Aun no hay categorías cargadas
                  </flux:heading>
                  <flux:description size="xs">
                    Agrega un categoría para comenzar
                  </flux:description>
                </flux:card>
              @endif
            </flux:tab.panel>
          @endforeach

        </flux:tab.group>
      </flux:card>
      {{-- #End Highlighted Categories --}}
    </div>

    <div class="space-y-6">
      {{-- Company Logos --}}
      <flux:card class="space-y-4 divide-y divide-gray-200">
        <flux:field>
          <div class="flex items-center justify-start gap-x-4">
            <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
              @if (is_string($settings['large_logo']) || !method_exists($new_large_logo, 'temporaryUrl'))
                <img
                  alt="Image Preview"
                  class="object-contain"
                  src="{{ Storage::disk('public')->url($settings['large_logo']) }}"
                />
              @else
                <img
                  alt="Image Preview"
                  class="object-contain"
                  src="{{ $new_large_logo->temporaryUrl() }}"
                />
              @endif
            </div>

            <div class="space-y-4">
              <flux:label>Large Logo</flux:label>
              <flux:description size="xs">
                Logo con texto. Recomendado: 400x100px. Formatos: PNG, JPG, SVG. Máximo: 2MB.
              </flux:description>
              <flux:input
                size="sm"
                type="file"
                wire:model="new_large_logo"
              />
              <div wire:loading wire:target="new_large_logo">
                <flux:icon.loading />
              </div>
              <flux:error name="new_large_logo" />
            </div>
          </div>
        </flux:field>

        <flux:field>
          <div class="flex items-center justify-start gap-x-4">
            <div class="h-full w-[150px] rounded-sm bg-gray-100 p-4">
              @if (is_string($settings['small_logo']) || !method_exists($new_small_logo, 'temporaryUrl'))
                <img
                  alt="Image Preview"
                  class="object-contain"
                  src="{{ Storage::disk('public')->url($settings['small_logo']) }}"
                />
              @else
                <img
                  alt="Image Preview"
                  class="object-contain"
                  src="{{ $new_small_logo->temporaryUrl() }}"
                />
              @endif
            </div>

            <div class="space-y-4">
              <flux:label>Small Logo</flux:label>
              <flux:description size="xs">
                Solo ícono. Recomendado: 64x64px. Formatos: PNG, JPG, SVG. Máximo: 1MB.
              </flux:description>
              <flux:input
                size="sm"
                type="file"
                wire:model="new_small_logo"
              />
              <div wire:loading wire:target="new_small_logo">
                <flux:icon.loading />
              </div>
              <flux:error name="new_small_logo" />
            </div>
          </div>
        </flux:field>
      </flux:card>
      {{-- #End Company Logos --}}

      {{-- Catalog Document --}}
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            Upload Document
          </flux:heading>
          <flux:description size="xs">
            Carga un documento PDF.
          </flux:description>
          <flux:separator />
        </header>

        <div class="space-y-4">
          <flux:label>Document</flux:label>
          <flux:input
            size="sm"
            type="file"
            wire:model="new_catalog_document"
          />
          <div wire:loading wire:target="new_catalog_document">
            <flux:icon.loading />
          </div>
          <flux:error name="new_catalog_document" />

          @if (isset($settings['catalog_document']))
            <div>
              <a
                class="text-blue-500"
                download
                href="{{ Storage::url($settings['catalog_document']) }}"
              >
                Download Current Document
              </a>
            </div>
          @endif
        </div>
      </flux:card>
      {{-- #End Catalog Document --}}

      {{-- Social Media Updates --}}
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            Social Media
          </flux:heading>
          <flux:description size="xs">
            Enlaces a tus redes sociales.
          </flux:description>
          <flux:separator />
        </header>
        <flux:input
          description="URL de la cuenta de Facebook"
          label="Facebook"
          placeholder="https://www.facebook.com/gateexport"
          size="sm"
          wire:model="general_info.social_media.facebook"
        />

        <flux:input
          description="URL de la cuenta de YouTube"
          label="YouTube"
          placeholder="https://www.youtube.com/channel/"
          size="sm"
          wire:model="general_info.social_media.youtube"
        />

        <flux:input
          description="URL de la cuenta de LinkedIn"
          label="LinkedIn"
          placeholder="https://www.linkedin.com/company/gateexport"
          size="sm"
          wire:model="general_info.social_media.linkedin"
        />
      </flux:card>
      {{-- #End Social Media Updates --}}

      {{-- Contact Information --}}
      <flux:card class="space-y-4">
        <header class="space-y-2">
          <flux:heading level="3" size="lg">
            Contact Information
          </flux:heading>
          <flux:description size="xs">
            Información de contacto.
          </flux:description>
          <flux:separator />
        </header>
        <flux:input
          label="Dirección"
          placeholder="Calle Principal #123"
          size="sm"
          wire:model="general_info.contact_information.address"
        />

        <div class="grid grid-cols-2 gap-4">
          <flux:input
            label="Teléfono"
            placeholder="+52 (123) 456-7890"
            size="sm"
            wire:model="general_info.contact_information.phone"
          />

          <flux:input
            label="Teléfono secundario"
            placeholder="+52 (123) 456-7890"
            size="sm"
            wire:model="general_info.contact_information.second_phone"
          />
        </div>

        <flux:input
          label="Enlace WhatsApp"
          placeholder="https://wa.me/123456789"
          size="sm"
          wire:model="general_info.contact_information.whatsapp_link"
        />

        <flux:input
          label="Correo electrónico corporativo"
          placeholder="contacto@empresa.com"
          size="sm"
          wire:model="general_info.contact_information.email"
        />
      </flux:card>
      {{-- #End Contact Information --}}
    </div>
  </section>

  <div>
    <flux:button type="submit" variant="primary">
      Save Settings
    </flux:button>
  </div>
</form>
