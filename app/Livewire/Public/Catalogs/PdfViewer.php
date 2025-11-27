<?php

namespace App\Livewire\Public\Catalogs;

use App\Models\CatalogFile;
use Livewire\Component;

class PdfViewer extends Component
{
    public $selectedPdf = null;

    public function mount()
    {
        $firstPdf = CatalogFile::query()
            ->latest()
            ->first();

        if ($firstPdf) {
            $this->selectedPdf = $firstPdf->fileUrl;
        }
    }

    public function render()
    {
        $pdfs = CatalogFile::query()
            ->latest()
            ->get();

        return view('livewire.public.catalogs.pdf-viewer', compact('pdfs'));
    }
}
