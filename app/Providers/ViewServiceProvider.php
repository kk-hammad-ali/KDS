<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share the last two notifications with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Retrieve the last two notifications for the authenticated user
                $notifications = Auth::user()->notifications()->latest()->take(3)->get();
                $view->with('notifications', $notifications);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
