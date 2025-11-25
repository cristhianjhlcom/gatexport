<div class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Artículos</flux:heading>

    <div class="align-items flex justify-end">
      <div></div>
      <flux:button href="{{ route('admin.articles.store') }}" icon:trailing="plus" size="sm">Nuevo Artículo</flux:button>
    </div>
  </header>

  {{-- Container --}}
  <flux:table>
    <flux:table.columns>
      <flux:table.column>Título</flux:table.column>
      <flux:table.column>Contenido</flux:table.column>
      <flux:table.column>Resumen</flux:table.column>
      <flux:table.column>Es Público?</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
      @forelse($articles as $article)
        <flux:table.row :key="$article->id">
          <flux:table.cell class="text-wrap">{{ $article->title['es'] }}</flux:table.cell>
          <flux:table.cell class="truncate text-wrap">{!! str()->words($article->summary['es'], 15) !!}</flux:table.cell>
          <flux:table.cell class="truncate text-wrap">{!! str()->words($article->content['es'], 15) !!}</flux:table.cell>
          <flux:table.cell>
            {{-- <livewire:admin.policies.is-published :$article /> --}}
          </flux:table.cell>
          <flux:table.cell>
            <flux:dropdown align="end" position="bottom">
              <flux:button icon="ellipsis-horizontal" variant="ghost"></flux:button>
              <flux:menu>
                <flux:menu.item href="{{ route('admin.articles.update', $article) }}" icon:trailing="pencil">
                  Editar
                </flux:menu.item>
                <flux:menu.item icon:trailing="trash" variant="danger" wire:click="delete({{ $article }})"
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
