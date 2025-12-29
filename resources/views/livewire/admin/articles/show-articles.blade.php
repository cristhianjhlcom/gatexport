<div class="space-y-6">
  <header>
    <flux:heading level="1" size="lg">Artículos</flux:heading>

    {{-- <div class="align-items flex justify-end">
      <div></div>
      <flux:button
        href="{{ route('admin.articles.store') }}"
        icon:trailing="plus"
        size="sm"
      >Nuevo Artículo</flux:button>
    </div> --}}
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
        <flux:table.row :key="$article['id']">
          <flux:table.cell class="text-wrap">{{ $article['title'] }}</flux:table.cell>
          <flux:table.cell class="truncate text-wrap">{!! str()->words($article['summary'], 15) !!}</flux:table.cell>
          <flux:table.cell class="truncate text-wrap">{!! str()->words($article['content'], 15) !!}</flux:table.cell>
        </flux:table.row>
      @empty
        <flux:table.row>
          <flux:table.cell class="text-wrap">No hay artículos.</flux:table.cell>
        </flux:table.row>
      @endforelse
    </flux:table.rows>
  </flux:table>
</div>
