<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\LargeCategory;
use Illuminate\Http\Request;
class QuoteController extends Controller
{
    // トップページ
    public function index()
    {
        // 大カテゴリ一覧を取得
        $largeCategories = LargeCategory::all();

        // ビューにデータを渡す
        return view('home', compact('popularQuotes', 'largeCategories'));
    }
    
    // 名言詳細ページ
    public function show($id)
    {
        $quote = Quote::with(['author', 'category'])->findOrFail($id);

        // 閲覧回数をインクリメント
        $quote->increment('popular_score');
        $quote->update(['last_accessed_at' => now()]);

        return view('quotes.show', compact('quote'));
    }
    public function popular()
    {
        $popularRankQuotes = Quote::orderBy('popular_score', 'desc')->paginate(10);
        return view('quotes.popular', compact('popularRankQuotes'));
    }
}
