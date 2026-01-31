<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\HubSpot\HubSpotService;

final class ArticleIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(HubSpotService $hubspot)
    {
        $articles = $hubspot->getListingArticles();

        return view('pages.articles.index', compact('articles'));
    }
}
