<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials._header', function($view) 
        {
            $view->with('user', \App\User::whereId(\Auth::id())->first());
        });

        view()->composer('partials._sidebar', function($view)
        {
            $view->with('months', array_of_months(11));
            $view->with('articles', \App\Post::latest()->limit(10)->get());
            $view->with('articlesPop', \App\Post::withCount('likes')->orderBy('likes_count', 'desc')->limit(10)->get());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
