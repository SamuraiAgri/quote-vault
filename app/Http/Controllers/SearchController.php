<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Proverb;
use App\Models\Hyakuninisshu;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 統合検索コントローラー
 * すべてのコンテンツタイプを横断的に検索
 */
class SearchController extends Controller
{
    private const PER_PAGE = 12;

    /**
     * 検索結果の表示
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $type = $request->input('type', 'all');

        // 初回アクセス時（キーワードがない場合）
        if (empty($keyword)) {
            return view('search.index', [
                'results' => null,
                'keyword' => null,
                'type' => $type,
            ]);
        }

        // キーワードのサニタイズ（XSS対策）
        $keyword = strip_tags($keyword);
        $keyword = mb_substr($keyword, 0, 100);

        // 検索タイプに応じて検索を実行
        switch ($type) {
            case 'quotes':
                $results = $this->searchQuotesPaginated($keyword);
                break;
            case 'proverbs':
                $results = $this->searchProverbsPaginated($keyword);
                break;
            case 'poems':
                $results = $this->searchPoemsPaginated($keyword);
                break;
            default:
                // 全検索の場合は各タイプの結果を統合（ページネーション付き）
                $results = $this->searchAllPaginated($keyword, $request);
                break;
        }

        return view('search.index', compact('results', 'keyword', 'type'));
    }

    /**
     * 名言を検索（ページネーション付き）
     */
    private function searchQuotesPaginated(string $keyword): LengthAwarePaginator
    {
        return Quote::search($keyword)
            ->with(['author', 'category'])
            ->orderByDesc('access_count')
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }

    /**
     * ことわざを検索（ページネーション付き）
     */
    private function searchProverbsPaginated(string $keyword): LengthAwarePaginator
    {
        try {
            return Proverb::search($keyword)
                ->with('category')
                ->orderByDesc('access_count')
                ->paginate(self::PER_PAGE)
                ->withQueryString();
        } catch (\Exception $e) {
            return new LengthAwarePaginator([], 0, self::PER_PAGE);
        }
    }

    /**
     * 百人一首を検索（ページネーション付き）
     */
    private function searchPoemsPaginated(string $keyword): LengthAwarePaginator
    {
        try {
            return Hyakuninisshu::search($keyword)
                ->with('poet')
                ->orderByDesc('access_count')
                ->paginate(self::PER_PAGE)
                ->withQueryString();
        } catch (\Exception $e) {
            return new LengthAwarePaginator([], 0, self::PER_PAGE);
        }
    }

    /**
     * 全コンテンツを検索（ページネーション付き）
     * KISS原則: シンプルに各タイプを個別ページネーション
     */
    private function searchAllPaginated(string $keyword, Request $request): array
    {
        return [
            'quotes' => Quote::search($keyword)
                ->with(['author', 'category'])
                ->orderByDesc('access_count')
                ->paginate(6, ['*'], 'quotes_page')
                ->withQueryString(),
            'proverbs' => $this->safeSearchProverbs($keyword, $request),
            'poems' => $this->safeSearchPoems($keyword, $request),
        ];
    }

    private function safeSearchProverbs(string $keyword, Request $request): LengthAwarePaginator
    {
        try {
            return Proverb::search($keyword)
                ->with('category')
                ->orderByDesc('access_count')
                ->paginate(6, ['*'], 'proverbs_page')
                ->withQueryString();
        } catch (\Exception $e) {
            return new LengthAwarePaginator([], 0, 6);
        }
    }

    private function safeSearchPoems(string $keyword, Request $request): LengthAwarePaginator
    {
        try {
            return Hyakuninisshu::search($keyword)
                ->with('poet')
                ->orderByDesc('access_count')
                ->paginate(6, ['*'], 'poems_page')
                ->withQueryString();
        } catch (\Exception $e) {
            return new LengthAwarePaginator([], 0, 6);
        }
    }
}
