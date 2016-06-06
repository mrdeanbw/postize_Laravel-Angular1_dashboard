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
            $view->with('posts', Post::with('author')->with('category')->where('status', 1)->orderByRaw(DB::raw('RAND()'))->take(6)->get());
        });
        view()->composer('partials.you-may-like', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->where('status', 1)->orderByRaw(DB::raw('RAND()'))->take(9)->get());
        });
        view()->composer('partials.top-stories', function($view)
        {
            $viewData = $view->getData();
            $posts = Post::with('author')->with('category')->where('status', 1);

            if(array_key_exists('category', $viewData)) {
                $posts->where('category_id', $viewData['category']['id']);
            }

            $view->with('posts', $posts->orderByRaw(DB::raw('RAND()'))->take(6)->get());
        });
        view()->composer('partials.slider', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->where('status', 1)->orderByRaw(DB::raw('RAND()'))->take(3)->get());
        });
        view()->composer('partials.sidebar-articles', function($view)
        {
            $view->with('posts', Post::with('author')->with('category')->where('status', 1)->orderByRaw(DB::raw('RAND()'))->take(3)->get());
        });

        view()->share('page', 'page');

        view()->composer('pages.post', function($view) {
            view()->share('page', 'post');
            $view->with('nextPost', Post::with('author')->with('category')->where('id', '!=', $view->post->id)->where('status', 1)->orderByRaw(DB::raw('RAND()'))->take(1)->first());
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
