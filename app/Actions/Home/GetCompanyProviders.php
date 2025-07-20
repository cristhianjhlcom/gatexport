<?php

declare(strict_types=1);

namespace App\Actions\Home;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

final class GetCompanyProviders
{
    public function execute(): array
    {
        $result = DB::transaction(function () {
            return Setting::get('providers', []);
        });

        return $result;
    }
}
