<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Quote;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // 人気の名言
            $popularQuotes = Quote::orderBy('popular_score', 'desc')->take(3)->get();
    
            // 直近でアクセスされたデータ
            $recentQuotes = Quote::orderBy('last_accessed_at', 'desc')->take(3)->get();
    
            // ビューにデータを共有
            $view->with([
                'popularQuotes' => $popularQuotes,
                'recentQuotes' => $recentQuotes,
            ]);
        });
    }
}
