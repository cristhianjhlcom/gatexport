<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.homepage.index');
    }
}
