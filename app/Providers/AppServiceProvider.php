<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Quote;
use Jenssegers\Agent\Agent;

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
        // レイアウトで共通して使用するデータを提供
        View::composer(['layout', 'home'], function ($view) {
            // エージェント情報
            $agent = new Agent();
            
            // 人気の名言（レイアウト用）
            $popularQuotes = Quote::popular()->limit(6)->get();
            
            // 最近アクセスされた名言（レイアウト用）
            $recentQuotes = Quote::recentlyAccessed()->limit(6)->get();
            
            // 大カテゴリ一覧（ホーム用）
            $largeCategories = \App\Models\LargeCategory::all();
            
            $view->with([
                'agent' => $agent,
                'popularQuotes' => $popularQuotes,
                'recentQuotes' => $recentQuotes,
                'largeCategories' => $largeCategories,
            ]);
        });
    }
}