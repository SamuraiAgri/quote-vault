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

            // 人気のことわざ・四字熟語（安全に取得）
            $popularProverbs = collect();
            try {
                if (class_exists('App\Models\Proverb')) {
                    $popularProverbs = \App\Models\Proverb::popular()->limit(6)->get();
                }
            } catch (\Exception $e) {
                // モデルが存在しない場合は空のコレクション
            }

            // 最近アクセスされたことわざ・四字熟語（安全に取得）
            $recentProverbs = collect();
            try {
                if (class_exists('App\Models\Proverb')) {
                    $recentProverbs = \App\Models\Proverb::recentlyAccessed()->limit(6)->get();
                }
            } catch (\Exception $e) {
                // モデルが存在しない場合は空のコレクション
            }

            // 人気の百人一首（安全に取得）
            $popularPoems = collect();
            try {
                if (class_exists('App\Models\Hyakuninisshu')) {
                    $popularPoems = \App\Models\Hyakuninisshu::popular()->limit(6)->get();
                }
            } catch (\Exception $e) {
                // モデルが存在しない場合は空のコレクション
            }

            // 最近アクセスされた百人一首（安全に取得）
            $recentPoems = collect();
            try {
                if (class_exists('App\Models\Hyakuninisshu')) {
                    $recentPoems = \App\Models\Hyakuninisshu::recentlyAccessed()->limit(6)->get();
                }
            } catch (\Exception $e) {
                // モデルが存在しない場合は空のコレクション
            }
            
            $view->with([
                'agent' => $agent,
                'popularQuotes' => $popularQuotes,
                'recentQuotes' => $recentQuotes,
                'largeCategories' => $largeCategories,
                'popularProverbs' => $popularProverbs,
                'recentProverbs' => $recentProverbs,
                'popularPoems' => $popularPoems,
                'recentPoems' => $recentPoems,
            ]);
        });
    }
}