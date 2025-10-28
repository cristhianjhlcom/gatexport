<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Services\Public\CompanyServicesService;
use Illuminate\Routing\Controller;

final class ServicesIndexController extends Controller
{
    protected string $title = 'Servicios';

    public function __construct(
        protected CompanyServicesService $services,
    ) {}

    public function __invoke(): \Illuminate\View\View
    {
        return view('pages.services.index', [
            'title' => $this->title,
            'hero' => $this->services->getHeroData(),
            'cycles' => $this->services->getCyclesData(),
            'services' => $this->services->getServicesData(),
            'authority' => $this->services->getAuthorityData(),
            'benefits' => $this->services->getBenefitsData(),
        ]);
    }
}
