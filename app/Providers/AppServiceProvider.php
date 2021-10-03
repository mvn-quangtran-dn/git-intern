<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //C1 share all view
        // $cate = 'view share';// data
        // view()->share('cate', $cate);

        //C2 share some view
        // $cate= Category::all();
        // view()->composer(['users.index', 'users.create'], function($view)  {
        //     $cate= Category::all(); 
        //     $view->with('cate', $cate);
        // });
        // //C3 share all in 1 folder
        view()->composer(['users.*', 'home.*', 'admin.index'], function($view) {
            $cate= Category::all();
            $view->with('cate', $cate);
        });
    }
}
