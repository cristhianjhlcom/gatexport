<?php

declare(strict_types=1);

namespace App\Services\Public;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

final class CompanyServicesService
{
    protected string $key = 'company_services';

    public function getHeroData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        return $companyServices['hero'] ??= [];
    }

    public function getCyclesData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        $cycles = $companyServices['cycles'] ?? [];

        usort($cycles, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $cycles;
    }

    protected function getCompanyServicesData(): array
    {
        return DB::transaction(function () {
            $locale = app()->getLocale();

            $setting = Setting::where('key', $this->key)
                ->where('group', 'home')
                ->where('locale', $locale)
                ->first();

            if (! $setting) {
                return [];
            }

            return $setting->value;
        });
    }
}
