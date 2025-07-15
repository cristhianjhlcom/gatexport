<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Actions\Home\GetAdvantages;
use App\Actions\Home\GetFeaturedCategoriesQuery;
use App\Actions\Home\GetSteps;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    public function __invoke(
        GetSteps $steps,
        GetAdvantages $advantages,
        GetFeaturedCategoriesQuery $categories
    ): \Illuminate\View\View {
        return view('pages.homepage.index')->with([
            'process' => $steps->handle(),
            'advantages' => $advantages->handle(),
            'categories' => $categories->handle(),
        ]);
    }
}
