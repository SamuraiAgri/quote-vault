<?php
// ファイルパス: app/Http/Controllers/QuoteController.php

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
        
        return view('home', compact('largeCategories', 'popularQuotes', 'recentQuotes'));
    }

    public function show($id)
    {
        $quote = Quote::with(['author', 'category'])->findOrFail($id);
        
        // アクセス数を増やす
        $quote->incrementAccessCount();
        
        // 関連する名言
        $relatedQuotes = Quote::where('category_id', $quote->category_id)
                             ->where('id', '!=', $quote->id)
                             ->limit(4)
                             ->get();
        
        return view('quotes.show', compact('quote', 'relatedQuotes'));
    }

    public function popular()
    {
        $popularRankQuotes = Quote::popular()->paginate(20);
        
        return view('quotes.popular', compact('popularRankQuotes'));
    }
}