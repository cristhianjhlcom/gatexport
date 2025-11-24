<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\FrequentlyAskedQuestion;

final class FaqIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $faqs = $this->getLatestFaqs();

        return view('pages.faqs.index', compact('faqs'));
    }

    private function getLatestFaqs()
    {
        return FrequentlyAskedQuestion::query()
            ->latest()
            ->get();
    }
}
