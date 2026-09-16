<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
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
        View::composer('ui-panel.side-bar', function ($view) {
            $view->with([
                'posts' => Post::latest()->take(6)->get(),
                'categories' => Category::all() 
            ]);
        });

    }
}
