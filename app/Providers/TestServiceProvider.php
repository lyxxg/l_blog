<?php
declare(strict_types=0);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TokenManageService;




class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('token.manage', function ($app) {
            return new TokenManageService();

                    });

    }
}
