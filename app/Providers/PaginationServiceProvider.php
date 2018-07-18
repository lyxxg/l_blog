<?php

namespace App\Providers;

use App\Presenters\PagiationPresenter;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\ServiceProvider;
class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */

   //重置laravel paginate样式
    public function boot()
    {


        \Illuminate\Pagination\LengthAwarePaginator::defaultView('common.pagination');


//        Paginator::presenter(function (AbstractPaginator $paginator) {
//            return new PagiationPresenter($paginator);
//        });

    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
