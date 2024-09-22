<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;



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
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $count = Cart::where('user_id', $userId)->count();
                $view->with('count', $count);
            }
        });
    }
}
