<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Actions\Catalog\GetCatalogFiles;
use App\Actions\Home\GetAbout;
use App\Actions\Home\GetCompanyProviders;
use App\Actions\Home\GetGeneralInformation;
use Illuminate\Routing\Controller;

final class AboutUsIndexController extends Controller
{
    protected string $title = 'Nuestra Historia';

    public function __invoke(): \Illuminate\View\View
    {
        return view('pages.about-us.index', [
            'title' => $this->title,
            'catalogs' => (new GetCatalogFiles)->execute(),
            'general_information' => (new GetGeneralInformation)->execute(),
            'about' => (new GetAbout)->execute(),
            'providers' => (new GetCompanyProviders)->execute(),
        ]);
    }
}
