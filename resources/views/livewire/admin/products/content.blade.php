@php
  $locales = [
      'es' => 'Español',
      'en' => 'Inglés',
  ];
@endphp

<flux:card>
  <flux:tab.group>
    <flux:tabs variant="segmented">
      @foreach ($locales as $locale => $value)
        <flux:tab name="{{ $locale }}">{{ $value }}</flux:tab>
      @endforeach
    </flux:tabs>

    @foreach ($locales as $locale => $value)
      <flux:tab.panel class="space-y-4" name="{{ $locale }}">
        <div class="space-y-4">
          <flux:input
            autocomplete="off"
            badge="Requerido"
            label="Nombre ({{ $value }})"
            placeholder="Lorem Ipsum"
            wire:model.blur="form.name.{{ $locale }}"
          />

          <flux:field>
            <flux:input.group>
              <flux:input.group.prefix>{{ env('APP_URL') }}</flux:input.group.prefix>
              <flux:input
                id="slug"
                placeholder="product-slug"
                wire:model='form.slug'
              />
            </flux:input.group>
            <flux:error name="form.slug" />
          </flux:field>

          <flux:editor
            badge="Opcional"
            label="Descripción ({{ $value }})"
            name="description"
            wire:model="form.description.{{ $locale }}"
          />
        </div>

        <div class="space-y-4">
          <flux:input
            autocomplete="off"
            label="Título SEO ({{ $value }})"
            placeholder="Pretty Title 📦"
            wire:model="form.seo.title.{{ $locale }}"
          />

          <flux:textarea
            autocomplete="off"
            label="Descripción SEO ({{ $value }})"
            placeholder="Descripción para los buscadores como Google, Bing, etc."
            rows="2"
            wire:model="form.seo.description.{{ $locale }}"
          />
        </div>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
