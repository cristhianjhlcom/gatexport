<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class CatalogFileIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('pages.catalog-files.index');
    }
}
