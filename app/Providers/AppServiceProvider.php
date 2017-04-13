<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Responsitory\Business;
use Laravel\Dusk\DuskServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $business = new Business();

        //        view share data
        $cateList = $business->getAllCate();
        $productList = [];
        foreach ($cateList as $cate)
            $productList[$cate->id] = $business->getProductByCate($cate->id)->shuffle()->take(4);
        View::share('productList', $productList);
        View::share('cateList', $cateList);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
