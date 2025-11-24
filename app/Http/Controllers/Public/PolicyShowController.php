<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Policy;

final class PolicyShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Policy $policy)
    {
        return view('pages.policies.show', compact('policy'));
    }
}
