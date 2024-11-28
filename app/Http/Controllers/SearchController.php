<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        // 初回アクセス時（キーワードがない場合）
        if (is_null($keyword)) {
            return view('search.index', ['results' => null, 'keyword' => null]);
        }

        // 名言と著者を検索
        $results = Quote::where(function ($query) use ($keyword) {
            $query->where('quote_text', 'like', "%$keyword%")
                  ->orWhere('quote_furigana', 'like', "%$keyword%");
        })
        ->orWhereHas('author', function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                  ->orWhere('furigana', 'like', "%$keyword%");
        })
        ->orderBy('quote_furigana')
        ->paginate(10);

        return view('search.index', compact('results', 'keyword'));
    }
}
