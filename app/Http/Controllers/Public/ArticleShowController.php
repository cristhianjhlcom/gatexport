<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\HubSpot\HubSpotService;

final class ArticleShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, HubSpotService $hubspot)
    {
        $article = $hubspot->getSingleArticle($id);
        abort_if(empty($article), 404, 'Artículo no encontrado');

        return view('pages.articles.show', compact('article'));
    }
}
