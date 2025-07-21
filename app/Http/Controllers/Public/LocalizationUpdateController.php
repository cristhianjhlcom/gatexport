<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use Illuminate\Routing\Controller;

final class LocalizationUpdateController extends Controller
{
    public function __invoke(string $locale)
    {
        if (!in_array($locale, config('localization.locales'))) {
            abort(400);
        }

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
