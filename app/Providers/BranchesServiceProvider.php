<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class BranchesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share the branches with all views
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->hasRole('admin')) {
                // Retrieve all branches for the authenticated user with the role 'admin'
                $branches = Branch::all();
                $view->with('branches', $branches);
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
