<section>
  {{-- <aside>
    <nav>
      @forelse ($pdfs as $pdf)
        <button>{{ $pdf->fileUrl }}</button>
      @empty
        <h2>No hay catálogos aún</h2>
      @endforelse
    </nav>
  </aside> --}}

  <div class="grid grid-cols-4 gap-4">
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
    <div>
      <img class="aspect-square object-cover" src="https://placehold.net/1.png">
    </div>
  </div>
</section>

@assets
  <script src="https://www.jsdelivr.com/package/npm/pdfjs-dist" defer></script>
  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css"> --}}
@endassets

@script
  <script>
    console.log('PDF Js');
  </script>
@endscript
