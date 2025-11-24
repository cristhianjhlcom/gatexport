<div class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Preguntas Frecuentes</flux:heading>

    <div class="align-items flex justify-end">
      <div></div>
      <flux:modal.trigger name="create-faq">
        <flux:button icon:trailing="plus" size="sm">Nueva FAQ</flux:button>
      </flux:modal.trigger>

      <flux:modal name="create-faq">
        <flux:tab.group>
          <flux:tabs variant="segmented">
            @foreach ($locales as $locale => $name)
              <flux:tab name="{{ $locale }}">{{ $name }}</flux:tab>
            @endforeach
          </flux:tabs>

          @foreach ($locales as $locale => $name)
            <flux:tab.panel :key="$locale" class="space-y-4" name="{{ $locale }}">
              <form class="space-y-6" wire:submit="save">
                <flux:input label="Pregunta ({{ $name }})" placeholder="¿Cómo puedo importar Palo Santo?"
                  wire:model="question.{{ $locale }}" />

                <flux:textarea label="Respuesta ({{ $name }})" placeholder="Nos encargamos de gestionar..."
                  wire:model="answer.{{ $locale }}" />

                <flux:checkbox :checked="$is_published" description="Hacer que esta pregunta frecuente sea visible en el sitio público."
                  label="Es público?" wire:model="is_published" />


                <div class="flex items-center gap-4">
                  <flux:button type="submit" variant="primary">Guardar</flux:button>

                  @if ($errors->any())
                    <span class="text-sm font-light italic text-zinc-400">Verifique todos los campos en ambos
                      idiomas.</span>
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
      @foreach ($locales as $locale => $name)
        <flux:table.column>Pregunta ({{ $name }})</flux:table.column>
        <flux:table.column>Respuesta ({{ $name }})</flux:table.column>
      @endforeach
      <flux:table.column>Es Público?</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
      @forelse($faqs as $faq)
        <flux:table.row :key="$faq->id">
          @foreach ($locales as $locale => $name)
            <flux:table.cell class="text-wrap">{{ $faq->question[$locale] }}</flux:table.cell>
            <flux:table.cell class="text-wrap">{{ $faq->answer[$locale] }}</flux:table.cell>
          @endforeach
          <flux:table.cell>
            <livewire:admin.faqs.is-published :$faq />
          </flux:table.cell>
          <flux:table.cell>
            <flux:dropdown align="end" position="bottom">
              <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
              <flux:menu>
                <flux:menu.item icon:trailing="pencil" wire:click="edit({{ $faq }})">
                  Editar
                </flux:menu.item>
                <flux:menu.item icon:trailing="trash" variant="danger" wire:click="delete({{ $faq }})"
                  wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir.">
                  Eliminar
                </flux:menu.item>
              </flux:menu>
            </flux:dropdown>
          </flux:table.cell>
        </flux:table.row>
      @empty
        <flux:table.row>
          <flux:table.cell class="text-wrap">No hay preguntas frecuentes.</flux:table.cell>
        </flux:table.row>
      @endforelse
    </flux:table.rows>
  </flux:table>
</div>
