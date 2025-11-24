<flux:card class="space-y-4">
  <header class="space-y-2">
    <flux:heading level="2" size="lg">
      Nuestro Compromiso
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
        <flux:input badge="Requerido" label="Título" wire:model="about.{{ $locale }}.commitment.title" />

        <flux:editor badge="Requerido" label="Descripción" wire:model="about.{{ $locale }}.commitment.description" />

        <div class="space-y-2 overflow-hidden">
          @php
            $image = $about['commitment_main_image'] ??= '';
            $hasImage = empty($image);
            $tmp = $newCommitmentMainImage ??= null;
          @endphp

          <flux:file-upload label="Imagen principal ({{ $name }})" size="sm" wire:model.live="newCommitmentMainImage">
            <flux:file-upload.dropzone :heading="$image" inline text="600x450 - JPG, PNG, SVG hasta 2MB" with-progress />
          </flux:file-upload>

          @if ($tmp)
            <flux:file-item :heading="$tmp->getClientOriginalName()" :image="$tmp->temporaryUrl()" :size="$tmp->getSize()" />
          @endif
        </div>

        <div class="space-y-2 overflow-hidden">
          @php
            $background = $about['commitment_background_image'] ??= '';
            $hasBackground = empty($background);
            $tmpBackground = $newCommitmentBackgroundImage ??= null;
          @endphp

          <flux:file-upload label="Imagen de fondo ({{ $name }})" size="sm" wire:model.live="newCommitmentBackgroundImage">
            <flux:file-upload.dropzone :heading="$background" inline text="900x500 - JPG, PNG, SVG hasta 2MB" with-progress />
          </flux:file-upload>

          @if ($tmpBackground)
            <flux:file-item :heading="$tmpBackground->getClientOriginalName()" :image="$tmpBackground->temporaryUrl()"
              :size="$tmpBackground->getSize()" />
          @endif
        </div>
      </flux:tab.panel>
    @endforeach
  </flux:tab.group>
</flux:card>
