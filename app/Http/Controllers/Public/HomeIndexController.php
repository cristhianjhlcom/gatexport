<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Actions\Home\GetAbout;
use App\Actions\Home\GetCompanyServices;
use App\Actions\Home\GetCompetitiveAdvantages;
use App\Actions\Home\GetFeaturedCategories;
use App\Actions\Home\GetGeneralInformation;
use App\Actions\Home\GetPromotionalBanners;
use App\Actions\Home\GetSteps;
use Illuminate\Routing\Controller;

final class HomeIndexController extends Controller
{
    protected string $title = 'Gate Export SAC | Ofrecemos productos 100% naturales Andino | Amazónico';

    public function __invoke(): \Illuminate\View\View
    {
        return view('pages.homepage.index', [
            'process' => (new GetSteps)->execute(),
            'competitive_advantages' => (new GetCompetitiveAdvantages)->execute(),
            'categories' => (new GetFeaturedCategories)->execute(),
            'promotional_banners' => (new GetPromotionalBanners)->execute(),
            'general_information' => (new GetGeneralInformation)->execute(),
            'about' => (new GetAbout)->execute(),
            'company_services' => (new GetCompanyServices)->execute(),
            'title' => $this->title,
        ]);
    }
}
