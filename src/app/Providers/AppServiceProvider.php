<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Listing;
use Illuminate\Support\Facades\Gate;
use App\Policies\ListingPolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Listing::class => ListingPolicy::class,
    ];
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
        $this->registerPolicies();
    }


    /**
     * Register the application's policies.
     *
     * @return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
