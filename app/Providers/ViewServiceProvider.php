<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer(['components.ui.desktop-sidebar', 'components.ui.mobile-sidebar'], function (View $view) {
            $languages = Language::all();
            $view->with('languages', $languages);
        });
    }
}
