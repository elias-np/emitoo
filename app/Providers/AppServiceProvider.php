<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\ImportBatch;
use App\Models\Invoice;
use App\Models\Sale;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar gates para proteção de empresa
        $this->registerGates();
    }

    /**
     * Registrar gates.
     */
    protected function registerGates(): void
    {
        $companyPolicy = new CompanyPolicy();

        // Gate para verificar se o modelo pertence à empresa do usuário
        Gate::define('belong-to-company', function ($user, $model) use ($companyPolicy) {
            return $companyPolicy->belongToCompany($user, $model);
        });
    }
}
