<?php
declare(strict_types=0);

/**
* app/Providers/TokenManageServiceProvider.php
*
*/
namespace App\Providers;

use App\Services\TokenManageService;

use Illuminate\Support\ServiceProvider;

/**
* token管理服务提供者
*
* Class TokenManageServiceProvider
* @package App\Providers
*/
class TokenManageServiceProvider extends ServiceProvider
{

/**
* Define your route model bindings, pattern filters, etc.
*
* @return void
*/
public function boot()
{
}

/**
* Register the application services.
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