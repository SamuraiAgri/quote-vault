<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    // 著者一覧
    public function index()
    {
        // 著者名を furigana カラムで50音順に並び替え、名言数も取得
        $authors = Author::withCount('quotes')->orderBy('furigana')->get();

        // 濁音や半濁音を正規化してグループ化
        $groupedAuthors = $authors->groupBy(function ($author) {
            $initial = mb_substr($author->furigana, 0, 1, 'UTF-8');
            return $this->normalizeKana($initial); // 正規化した文字でグループ化
        });

        return view('authors.index', compact('groupedAuthors'));
    }

    /**
     * 濁音や半濁音を清音に正規化
     */
    private function normalizeKana($char)
    {
        $kanaMap = [
            'が' => 'か',
            'ぎ' => 'き',
            'ぐ' => 'く',
            'げ' => 'け',
            'ご' => 'こ',
            'ざ' => 'さ',
            'じ' => 'し',
            'ず' => 'す',
            'ぜ' => 'せ',
            'ぞ' => 'そ',
            'だ' => 'た',
            'ぢ' => 'ち',
            'づ' => 'つ',
            'で' => 'て',
            'ど' => 'と',
            'ば' => 'は',
            'び' => 'ひ',
            'ぶ' => 'ふ',
            'べ' => 'へ',
            'ぼ' => 'ほ',
            'ぱ' => 'は',
            'ぴ' => 'ひ',
            'ぷ' => 'ふ',
            'ぺ' => 'へ',
            'ぽ' => 'ほ',
        ];

        // マッピングが存在すれば変換、なければそのまま返す
        return $kanaMap[$char] ?? $char;
    }

    // 特定著者の名言一覧
    public function show($id)
    {
        $author = Author::with([
            'quotes' => function ($query) {
                $query->with('category')->orderBy('access_count', 'desc');
            }
        ])->findOrFail($id);

        return view('authors.show', compact('author'));
    }
}
