<?php

namespace App\Providers;

use View;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		View::composer(['admin.posts.create', 'admin.posts.edit'], function($view) {
            $view->with(['categories' => Category::get(), 'tags' => Tag::get()]);
        });

        View::composer(['pages._sidebar'], function($view) {
            $popular    = Post::orderBy('views', 'DESC')->take(3)->get();
            $featured   = Post::where('is_featured', 1)->orderBy('id', 'DESC')->take(3)->get();
            $recent     = Post::orderBy('id', 'DESC')->take(4)->get();
            $categories = Category::withCount('posts')->get();

            $view->with(compact('popular', 'featured', 'recent', 'categories'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    
    }
}
