<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

/**
 * パンくずリスト生成サービス
 * 
 * SOLID原則: 単一責任 - パンくずリストの生成のみを担当
 * DRY原則: 各ビューで個別に定義せず、ルートベースで自動生成
 */
class BreadcrumbService
{
    /**
     * 現在のルートに基づいてパンくずリストを生成
     *
     * @param array $params 追加パラメータ（モデルデータなど）
     * @return array
     */
    public function generate(array $params = []): array
    {
        $routeName = Route::currentRouteName();
        
        if (!$routeName) {
            return [];
        }

        $breadcrumbs = [
            ['name' => 'ホーム', 'url' => route('home')]
        ];

        $routeBreadcrumbs = $this->getRouteBreadcrumbs($routeName, $params);
        
        return array_merge($breadcrumbs, $routeBreadcrumbs);
    }

    /**
     * ルート名に基づいてパンくずリストを取得
     */
    private function getRouteBreadcrumbs(string $routeName, array $params): array
    {
        // 名言・格言関連
        if (str_starts_with($routeName, 'largecategories.') || 
            str_starts_with($routeName, 'categories.') || 
            str_starts_with($routeName, 'quotes.') ||
            str_starts_with($routeName, 'authors.')) {
            return $this->getQuoteBreadcrumbs($routeName, $params);
        }

        // ことわざ・四字熟語関連
        if (str_starts_with($routeName, 'proverbs.') || 
            str_starts_with($routeName, 'proverb-categories.')) {
            return $this->getProverbBreadcrumbs($routeName, $params);
        }

        // 百人一首関連
        if (str_starts_with($routeName, 'hyakuninisshu.') || 
            str_starts_with($routeName, 'poets.')) {
            return $this->getHyakuninisshuBreadcrumbs($routeName, $params);
        }

        // 検索関連
        if ($routeName === 'search.index') {
            return [['name' => '検索']];
        }

        // 静的ページ
        return $this->getStaticPageBreadcrumbs($routeName);
    }

    /**
     * 名言・格言関連のパンくずリスト
     */
    private function getQuoteBreadcrumbs(string $routeName, array $params): array
    {
        $crumbs = [];

        switch ($routeName) {
            case 'largecategories.index':
                $crumbs[] = ['name' => '名言・格言'];
                break;

            case 'largecategories.show':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                $crumbs[] = ['name' => $params['largeCategory']->name ?? 'カテゴリ'];
                break;

            case 'categories.show':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                if (isset($params['category']->largeCategory)) {
                    $lc = $params['category']->largeCategory;
                    $crumbs[] = ['name' => $lc->name, 'url' => route('largecategories.show', $lc->id)];
                }
                $crumbs[] = ['name' => $params['category']->name ?? 'カテゴリ'];
                break;

            case 'quotes.show':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                if (isset($params['quote']->category->largeCategory)) {
                    $lc = $params['quote']->category->largeCategory;
                    $crumbs[] = ['name' => $lc->name, 'url' => route('largecategories.show', $lc->id)];
                }
                if (isset($params['quote']->category)) {
                    $cat = $params['quote']->category;
                    $crumbs[] = ['name' => $cat->name, 'url' => route('categories.show', $cat->id)];
                }
                $crumbs[] = ['name' => ($params['quote']->author->name ?? '') . 'の名言'];
                break;

            case 'quotes.popular':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                $crumbs[] = ['name' => '人気の名言'];
                break;

            case 'authors.index':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                $crumbs[] = ['name' => '著者一覧'];
                break;

            case 'authors.show':
                $crumbs[] = ['name' => '名言・格言', 'url' => route('largecategories.index')];
                $crumbs[] = ['name' => '著者一覧', 'url' => route('authors.index')];
                $crumbs[] = ['name' => $params['author']->name ?? '著者'];
                break;
        }

        return $crumbs;
    }

    /**
     * ことわざ・四字熟語関連のパンくずリスト
     */
    private function getProverbBreadcrumbs(string $routeName, array $params): array
    {
        $crumbs = [];
        $baseUrl = route('proverbs.index');
        $baseName = 'ことわざ・四字熟語';

        switch ($routeName) {
            case 'proverbs.index':
                $crumbs[] = ['name' => $baseName];
                break;

            case 'proverbs.show':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                if (isset($params['proverb']->category)) {
                    $cat = $params['proverb']->category;
                    $crumbs[] = ['name' => $cat->name, 'url' => route('proverb-categories.show', $cat->id)];
                }
                $crumbs[] = ['name' => $params['proverb']->word ?? '詳細'];
                break;

            case 'proverbs.by-type':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => $params['typeName'] ?? '種類別'];
                break;

            case 'proverbs.search':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '検索'];
                break;

            case 'proverbs.popular':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '人気ランキング'];
                break;

            case 'proverb-categories.index':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => 'カテゴリ一覧'];
                break;

            case 'proverb-categories.show':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => 'カテゴリ一覧', 'url' => route('proverb-categories.index')];
                $crumbs[] = ['name' => $params['category']->name ?? 'カテゴリ'];
                break;
        }

        return $crumbs;
    }

    /**
     * 百人一首関連のパンくずリスト
     */
    private function getHyakuninisshuBreadcrumbs(string $routeName, array $params): array
    {
        $crumbs = [];
        $baseUrl = route('hyakuninisshu.index');
        $baseName = '百人一首';

        switch ($routeName) {
            case 'hyakuninisshu.index':
                $crumbs[] = ['name' => $baseName];
                break;

            case 'hyakuninisshu.show':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $poem = $params['poem'] ?? null;
                $crumbs[] = ['name' => $poem ? "第{$poem->number}番" : '詳細'];
                break;

            case 'hyakuninisshu.by-season':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => ($params['season'] ?? '') . 'の歌'];
                break;

            case 'hyakuninisshu.by-theme':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => ($params['theme'] ?? '') . 'の歌'];
                break;

            case 'hyakuninisshu.search':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '検索'];
                break;

            case 'hyakuninisshu.popular':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '人気ランキング'];
                break;

            case 'poets.index':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '歌人一覧'];
                break;

            case 'poets.show':
                $crumbs[] = ['name' => $baseName, 'url' => $baseUrl];
                $crumbs[] = ['name' => '歌人一覧', 'url' => route('poets.index')];
                $crumbs[] = ['name' => $params['poet']->name ?? '歌人'];
                break;
        }

        return $crumbs;
    }

    /**
     * 静的ページのパンくずリスト
     */
    private function getStaticPageBreadcrumbs(string $routeName): array
    {
        $pages = [
            'privacy' => 'プライバシーポリシー',
            'terms' => '利用規約',
            'contact' => 'お問い合わせ',
            'random.daily' => '今日のおすすめ',
        ];

        return isset($pages[$routeName]) 
            ? [['name' => $pages[$routeName]]] 
            : [];
    }
}
