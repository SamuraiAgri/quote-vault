<?php
// app/Http/Controllers/QuoteController.php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\LargeCategory;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        // 大カテゴリ一覧
        $largeCategories = LargeCategory::all();
        
        // 人気の名言
        $popularQuotes = Quote::popular()->limit(6)->get();
        
        // 最近アクセスされた名言
        $recentQuotes = Quote::recentlyAccessed()->limit(6)->get();

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
                $popularPoems = \App\Models\Hyakuninisshu::popular()->limit(6)->get();
            }
        } catch (\Exception $e) {
            // モデルが存在しない場合は空のコレクション
        }
        
        return view('home', compact(
            'largeCategories', 
            'popularQuotes', 
            'recentQuotes',
            'popularProverbs',
            'popularPoems'
        ));
    }

    public function show($id)
    {
        $quote = Quote::with(['author', 'category.largeCategory'])->findOrFail($id);
        
        // アクセス数を増やす
        $quote->incrementAccessCount();
        
        // 関連する名言（同じカテゴリの他の名言）
        $relatedQuotes = Quote::where('category_id', $quote->category_id)
                             ->where('id', '!=', $quote->id)
                             ->with(['author'])
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