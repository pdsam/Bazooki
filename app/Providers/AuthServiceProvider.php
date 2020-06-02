<?php

namespace App\Providers;

use App\AuctionTransaction;
use App\Policies\AuctionTransactionPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\Auth\AdminProvider;
use App\Bazooker;
use App\PaymentMethod;
use App\Policies\BazookerPolicy;
use App\Policies\PaymentMethodPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Bazooker::class => BazookerPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
        AuctionTransaction::class => AuctionTransactionPolicy::class
    ]; 
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('admin-driver', function($app, array $config) {
            return new AdminProvider($app);
        });
    }
}
