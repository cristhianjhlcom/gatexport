@php
  $locales = [
      'es' => 'Español',
      'en' => 'Inglés',
  ];
@endphp

<div>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $value)
        <flux:tab name="{{ $locale }}">{{ $value }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $value)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <flux:card class="space-y-4">
          <flux:input
            autocomplete="off"
            badge="Requerido"
            description:trailing="Versión en {{ strtolower($value) }} del nombre"
            label="Nombre"
            placeholder="Lorem Ipsum"
            wire:model.blur="form.name.{{ $locale }}"
          />

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}</flux:input.group.prefix>
              <flux:input
                id="slug"
                placeholder="product-slug"
                readonly
                wire:model='form.slug'
              />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>

          <flux:editor
            badge="Optional"
            description:trailing="Descripción del producto, debe ser de 500 caracteres como máximo."
            label="Descripción"
            name="description"
            wire:model="form.description.{{ $locale }}"
          />
        </flux:card>

        <flux:card class="space-y-4">
          <flux:input
            autocomplete="off"
            description:trailing="Versión en {{ strtolower($value) }} del nombre"
            label="Título SEO"
            placeholder="Pretty Title 📦"
            wire:model.blur="form.seo.title.{{ $locale }}"
          />

          <flux:textarea
            autocomplete="off"
            description:trailing="Versión en {{ strtolower($value) }} del nombre"
            label="Descripción SEO"
            placeholder="Descripción para los buscadores como Google, Bing, etc."
            rows="2"
            wire:model.lazy="form.seo.description.{{ $locale }}"
          />
        </flux:card>

      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</div>
