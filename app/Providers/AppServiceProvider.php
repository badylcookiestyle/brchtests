<?php

namespace App\Providers;


use Illuminate\Support\Facades\Auth;
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


        View::composer('*', function ($view) {
            //Amount of notifications ;-;
            $data = 0;
            //Amount of reports
            $reports = 0;
            if (Auth::check()) {
                $data = DB::table("reports")
                    ->where("user_id", "=", Auth::id())
                    ->where("read", false)
                    ->where("action", "!=", "reportOnly")->count();
                if (Auth::user()->isAdmin() == 1) {
                    $reports = DB::table("reports")->where("action", "reportOnly")->where("read", false)->count();
                }
            }
            return $view->with('data', $data)->with("reports", $reports);
        });


    }
}
