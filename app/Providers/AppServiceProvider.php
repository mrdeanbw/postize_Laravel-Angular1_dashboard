<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.related', function($view)
        {
            $view->with('posts', \App\Models\Post::with('author')->take(6)->get());
        });
        view()->composer('partials.you-may-like', function($view)
        {
            $view->with('posts', \App\Models\Post::with('author')->take(6)->get());
        });
        view()->share('page', 'page');

        view()->composer('pages.post', function($view) {
            $view->share('page', 'post');
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
