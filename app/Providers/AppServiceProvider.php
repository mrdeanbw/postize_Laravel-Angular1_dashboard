<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use DB;

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
            $view->with('posts', Post::with('author')->with('category')->orderByRaw(DB::raw('RAND()'))->take(6)->get());
        });
        view()->composer('partials.you-may-like', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->orderByRaw(DB::raw('RAND()'))->take(9)->get());
        });
        view()->composer('partials.top-stories', function($view)
        {
            $viewData = $view->getData();
            $posts = Post::with('author')->with('category');

            if(array_key_exists('category_id', $viewData)) {
                $posts->where('category_id', $viewData['category_id']);
            }

            $view->with('posts', $posts->orderByRaw(DB::raw('RAND()'))->take(6)->get());
        });
        view()->composer('partials.slider', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->orderByRaw(DB::raw('RAND()'))->take(3)->get());
        });
        view()->composer('partials.sidebar-articles', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->orderByRaw(DB::raw('RAND()'))->take(3)->get());
        });

        view()->share('page', 'page');

        view()->composer('pages.post', function($view) {
            view()->share('page', 'post');
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
