<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Actions\Home\GetAbout;
use App\Actions\Home\GetAdvantages;
use App\Actions\Home\GetFeaturedCategories;
use App\Actions\Home\GetGeneralInformation;
use App\Actions\Home\GetPromotionalBanners;
use App\Actions\Home\GetSteps;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    public function __invoke(): \Illuminate\View\View
    {
        return view('pages.homepage.index')->with([
            'process' => (new GetSteps)->execute(),
            'advantages' => (new GetAdvantages)->execute(),
            'categories' => (new GetFeaturedCategories)->execute(),
            'promotional_banners' => (new GetPromotionalBanners)->execute(),
            'general_information' => (new GetGeneralInformation)->execute(),
            'about' => (new GetAbout)->execute(),
        ]);
    }
}
