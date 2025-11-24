<div class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Políticas</flux:heading>

    <div class="align-items flex justify-end">
      <div></div>
      <flux:button href="{{ route('admin.policies.store') }}" icon:trailing="plus" size="sm">Nueva Política</flux:button>
    </div>
  </header>

  {{-- Container --}}
  <flux:table>
    <flux:table.columns>
      @foreach ($locales as $locale => $name)
        <flux:table.column>Título ({{ $name }})</flux:table.column>
        <flux:table.column>Contenido ({{ $name }})</flux:table.column>
      @endforeach
      <flux:table.column>Es Público?</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
      @forelse($policies as $policy)
        <flux:table.row :key="$policy->id">
          @foreach ($locales as $locale => $name)
            <flux:table.cell class="text-wrap">{{ $policy->title[$locale] }}</flux:table.cell>
            <flux:table.cell class="truncate text-wrap">{!! str()->words($policy->content[$locale], 15) !!}</flux:table.cell>
          @endforeach
          <flux:table.cell>
            <livewire:admin.policies.is-published :$policy />
          </flux:table.cell>
          <flux:table.cell>
            <flux:dropdown align="end" position="bottom">
              <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
              <flux:menu>
                <flux:menu.item href="{{ route('admin.policies.update', $policy) }}" icon:trailing="pencil">
                  Editar
                </flux:menu.item>
                <flux:menu.item icon:trailing="trash" variant="danger" wire:click="delete({{ $policy }})"
                  wire:confirm.prevent="Estas seguro? Esta operación no se puede revertir.">
                  Eliminar
                </flux:menu.item>
              </flux:menu>
            </flux:dropdown>
          </flux:table.cell>
        </flux:table.row>
      @empty
        <flux:table.row>
          <flux:table.cell class="text-wrap">No hay políticas.</flux:table.cell>
        </flux:table.row>
      @endforelse
    </flux:table.rows>
  </flux:table>
</div>
