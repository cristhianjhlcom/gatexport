<?php

declare(strict_types=1);

namespace App\Services\Public;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

final class CompanyServicesService
{
    private string $key = 'company_services';

    public function getHeroData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        return $companyServices['hero'] ??= [];
    }

    public function getCyclesData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        $data = $companyServices['cycles'] ?? [];

        usort($data, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $data;
    }

    public function getServicesData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        $data = $companyServices['services'] ?? [];

        usort($data, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $data;
    }

    public function getAuthorityData(): array
    {
        $data = $this->getCompanyServicesData();

        return $data['authority'] ?? [];
    }

    public function getBenefitsData(): array
    {
        $companyServices = $this->getCompanyServicesData();

        $data = $companyServices['benefits'] ?? [];

        usort($data, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $data;
    }

    private function getCompanyServicesData(): array
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
