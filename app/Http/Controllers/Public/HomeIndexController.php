<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Actions\Home\GetAbout;
use App\Actions\Home\GetCompanyServices;
use App\Actions\Home\GetCompetitiveAdvantages;
use App\Actions\Home\GetExportContinents;
use App\Actions\Home\GetGeneralInformation;
use App\Actions\Home\GetHighlightedCategories;
use App\Actions\Home\GetPromotionalBanners;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    protected string $title = 'Gate Export SAC | Ofrecemos productos 100% naturales Andino | Amazónico';

    public function __invoke(): \Illuminate\View\View
    {
        return view('pages.homepage.index', [
            'promotional_banners' => (new GetPromotionalBanners)->execute(),
            'general_information' => (new GetGeneralInformation)->execute(),
            'about' => (new GetAbout)->execute(),
            'competitive_advantages' => (new GetCompetitiveAdvantages)->execute(),
            'highlighted_categories' => (new GetHighlightedCategories)->execute(),
            'company_services' => (new GetCompanyServices)->execute(),
            'export_continents' => (new GetExportContinents)->execute(),
            'title' => $this->title,
        ]);
    }
}
