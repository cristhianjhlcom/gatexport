<div class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Catálogos en PDF</flux:heading>

    <div class="align-items flex justify-end">
      <div></div>
      <flux:modal.trigger name="create-catalog">
        <flux:button icon:trailing="plus" size="sm">Nuevo Catalogo</flux:button>
      </flux:modal.trigger>

      <flux:modal class="w-2/3" name="create-catalog">
        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>

          @foreach ($locales as $locale => $name)
            <flux:tab.panel
              :key="$locale"
              class="space-y-4"
              name="{{ $locale }}"
            >
              <form class="space-y-6" wire:submit="save">
                <flux:input
                  badge="Opcional"
                  label="Título ({{ $name }})"
                  placeholder="¿Cómo puedo importar Palo Santo?"
                  wire:model="title.{{ $locale }}"
                />

                <flux:textarea
                  badge="Opcional"
                  label="Descripción Corta ({{ $name }})"
                  placeholder="Nos encargamos de gestionar..."
                  wire:model="short_description.{{ $locale }}"
                />

                <div class="space-y-2 overflow-hidden">
                  @if ($savedFile[$locale])
                    <flux:file-item :heading="$savedFile[$locale]" />
                  @endif

                  <flux:file-upload
                    label="Archivo de catalogo ({{ $name }})"
                    size="sm"
                    type="file"
                    wire:model="file.{{ $locale }}"
                  >
                    <flux:file-upload.dropzone
                      heading="Arrastra los archivo o has clic para buscar"
                      inline
                      text="PDF up to 5MB"
                      with-progress
                    />
                  </flux:file-upload>

                  @if ($file[$locale])
                    <flux:file-item :heading="$file[$locale]->getClientOriginalName()" />
                  @endif
                </div>

                <div class="flex items-center gap-4">
                  <flux:button type="submit" variant="primary">Guardar</flux:button>

                  @if ($errors->any())
                    <span class="text-sm font-light italic text-zinc-400">
                      Verifique todos los campos en ambos idiomas.
                    </span>
                  @endif
                </div>
              </form>
            </flux:tab.panel>
          @endforeach
        </flux:tab.group>
      </flux:modal>
    </div>
  </header>

  {{-- Container --}}
  <flux:table>
    <flux:table.columns>
      <flux:table.column>Título</flux:table.column>
      <flux:table.column>Contenido</flux:table.column>
      <flux:table.column>Ruta</flux:table.column>
      <flux:table.column>Fecha</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
      @forelse($files as $item)
        <flux:table.row :key="$item->id">
          <flux:table.cell class="text-wrap">{{ $item->title['es'] ?? '-' }}</flux:table.cell>
          <flux:table.cell class="truncate text-wrap">{!! str()->words($item->short_description['es'], 15) !!}</flux:table.cell>
          <flux:table.cell class="truncate">{{ $item->filepath['es'] }}</flux:table.cell>
          <flux:table.cell>
            {{ $item->created_at->format('d, M Y h:m:s') }}
          </flux:table.cell>
          <flux:table.cell>
            <flux:dropdown align="end" position="bottom">
              <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
              <flux:menu>
                <flux:menu.item icon:trailing="pencil" wire:click="edit({{ $item }})">
                  Editar
                </flux:menu.item>
                <flux:menu.item
                  icon:trailing="trash"
                  variant="danger"
                  wire:click="delete({{ $item }})"
                  wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir."
                >
                  Eliminar
                </flux:menu.item>
              </flux:menu>
            </flux:dropdown>
          </flux:table.cell>
        </flux:table.row>
      @empty
        <flux:table.row>
          <flux:table.cell class="text-wrap">No hay archivos.</flux:table.cell>
        </flux:table.row>
      @endforelse
    </flux:table.rows>
  </flux:table>
</div>
