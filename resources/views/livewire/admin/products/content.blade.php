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
          <flux:input autocomplete="off" badge="Requerido" label="Nombre ({{ $value }})" placeholder="Lorem Ipsum"
            wire:model.blur="form.name.{{ $locale }}" />

          <flux:editor badge="Opcional" label="Descripción ({{ $value }})" name="description"
            wire:model="form.description.{{ $locale }}" />
        </div>

        <div class="space-y-4">
          <flux:input autocomplete="off" label="Título SEO ({{ $value }})" placeholder="Pretty Title 📦"
            wire:model="form.seo.title.{{ $locale }}" />

          <flux:textarea autocomplete="off" label="Descripción SEO ({{ $value }})"
            placeholder="Descripción para los buscadores como Google, Bing, etc." rows="2"
            wire:model="form.seo.description.{{ $locale }}" />
        </div>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>

  <div class="mt-4 grid grid-cols-1 gap-x-4 sm:grid-cols-2">
    <flux:field>
      <flux:label badge="Requerido">Slug (Español)</flux:label>
      <flux:input.group>
        <flux:input.group.prefix>/</flux:input.group.prefix>
        <flux:input id="slug" placeholder="product-slug" wire:model.blur='form.slug' />
      </flux:input.group>
      <flux:description>Auto-generado del nombre, editable</flux:description>
      <flux:error name="form.slug" />
    </flux:field>

    <flux:field>
      <flux:label badge="Opcional">Slug (English)</flux:label>
      <flux:input.group>
        <flux:input.group.prefix>/</flux:input.group.prefix>
        <flux:input id="slug_en" placeholder="product-slug" wire:model.blur='form.slug_en' />
      </flux:input.group>
      <flux:description>Leave empty to use Spanish slug</flux:description>
      <flux:error name="form.slug_en" />
    </flux:field>
  </div>
</flux:card>
