<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
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

        Paginator::useBootstrap();

        //Amount of notifications ;-;


        return View::composer('*', function($view){
            $data = DB::table("reports")->where("user_id","=",Auth::id())->where("read",false)->count();
            $view->with('data', $data);
        });


    }
}
