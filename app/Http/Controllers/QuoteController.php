<?php
// app/Http/Controllers/QuoteController.php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\LargeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    public function index()
    {
        // 大カテゴリ一覧
        $largeCategories = LargeCategory::all();

        // 人気の名言
        $popularQuotes = Quote::popular()->with(['author', 'category'])->limit(6)->get();

        // 最近アクセスされた名言
        $recentQuotes = Quote::recentlyAccessed()->with(['author'])->limit(6)->get();

        // 今日の名言（1日1回キャッシュ）
        $dailyQuote = Cache::remember('daily_quote_' . date('Y-m-d'), 86400, function () {
            return Quote::with(['author', 'category'])
                ->inRandomOrder()
                ->first();
        });

        // 人気のことわざ・四字熟語（安全に取得）
        $popularProverbs = collect();
        try {
            if (class_exists('App\Models\Proverb')) {
                $popularProverbs = \App\Models\Proverb::popular()->limit(6)->get();
            }
        } catch (\Exception $e) {
            // モデルが存在しない場合は空のコレクション
        }

        // 人気の百人一首（安全に取得）
        $popularPoems = collect();
        try {
            if (class_exists('App\Models\Hyakuninisshu')) {
                $popularPoems = \App\Models\Hyakuninisshu::popular()->with(['poet'])->limit(6)->get();
            }
        } catch (\Exception $e) {
            // モデルが存在しない場合は空のコレクション
        }

        return view('home', compact(
            'largeCategories',
            'popularQuotes',
            'recentQuotes',
            'dailyQuote',
            'popularProverbs',
            'popularPoems'
        ));
    }

    public function show($id)
    {
        $quote = Quote::with(['author', 'category.largeCategory'])->findOrFail($id);

        // アクセス数を増やす
        $quote->incrementAccessCount();

        // 関連する名言（同じカテゴリの他の名言、人気順）
        $relatedQuotes = Quote::where('category_id', $quote->category_id)
            ->where('id', '!=', $quote->id)
            ->with(['author'])
            ->orderBy('access_count', 'desc')
            ->limit(4)
            ->get();

        return view('quotes.show', compact('quote', 'relatedQuotes'));
    }

    public function popular()
    {
        $popularRankQuotes = Quote::popular()->with(['author', 'category'])->paginate(20);

        return view('quotes.popular', compact('popularRankQuotes'));
    }
}