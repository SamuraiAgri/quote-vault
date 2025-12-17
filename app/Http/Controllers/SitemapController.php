<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Quote;
use App\Models\Author;
use App\Models\Category;
use App\Models\LargeCategory;
use App\Models\Proverb;
use App\Models\ProverbCategory;
use App\Models\Hyakuninisshu;
use App\Models\Poet;

/**
 * サイトマップコントローラー
 * 単一責任の原則：サイトマップの生成のみを担当
 */
class SitemapController extends Controller
{
    /**
     * XMLサイトマップを生成して返す
     */
    public function index()
    {
        // 静的ページのURL
        $staticPages = $this->getStaticPages();
        
        // 動的ページのURL
        $dynamicPages = $this->getDynamicPages();
        
        // すべてのURLをマージ
        $urls = array_merge($staticPages, $dynamicPages);
        
        return response()
            ->view('sitemap.xml', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * 静的ページのURL一覧を取得
     * DRY原則：URLの定義を一箇所に集約
     */
    private function getStaticPages(): array
    {
        return [
            [
                'loc' => route('home'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('largecategories.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('authors.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('quotes.popular'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
            [
                'loc' => route('proverbs.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('proverb-categories.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('proverbs.popular'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
            [
                'loc' => route('hyakuninisshu.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => route('poets.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('hyakuninisshu.popular'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
            [
                'loc' => route('search.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            [
                'loc' => route('privacy'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.3',
            ],
            [
                'loc' => route('terms'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.3',
            ],
            [
                'loc' => route('contact'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.3',
            ],
        ];
    }

    /**
     * 動的ページのURL一覧を取得
     * 関心の分離：各コンテンツタイプごとにメソッドを分離
     */
    private function getDynamicPages(): array
    {
        $urls = [];
        
        // 名言・格言関連
        $urls = array_merge($urls, $this->getQuoteUrls());
        
        // ことわざ・四字熟語関連
        $urls = array_merge($urls, $this->getProverbUrls());
        
        // 百人一首関連
        $urls = array_merge($urls, $this->getHyakuninisshuUrls());
        
        return $urls;
    }

    /**
     * 名言・格言関連のURL
     */
    private function getQuoteUrls(): array
    {
        $urls = [];
        
        // 大カテゴリ
        LargeCategory::all()->each(function ($largeCategory) use (&$urls) {
            $urls[] = [
                'loc' => route('largecategories.show', $largeCategory->id),
                'lastmod' => $largeCategory->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        });
        
        // カテゴリ
        Category::all()->each(function ($category) use (&$urls) {
            $urls[] = [
                'loc' => route('categories.show', $category->id),
                'lastmod' => $category->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        });
        
        // 著者
        Author::all()->each(function ($author) use (&$urls) {
            $urls[] = [
                'loc' => route('authors.show', $author->id),
                'lastmod' => $author->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        });
        
        // 名言詳細（最新の1000件）
        Quote::orderBy('updated_at', 'desc')
            ->limit(1000)
            ->get()
            ->each(function ($quote) use (&$urls) {
                $urls[] = [
                    'loc' => route('quotes.show', $quote->id),
                    'lastmod' => $quote->updated_at->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            });
        
        return $urls;
    }

    /**
     * ことわざ・四字熟語関連のURL
     */
    private function getProverbUrls(): array
    {
        $urls = [];
        
        // カテゴリ
        ProverbCategory::all()->each(function ($category) use (&$urls) {
            $urls[] = [
                'loc' => route('proverb-categories.show', $category->id),
                'lastmod' => $category->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        });
        
        // 種類別
        $types = ['ことわざ', '四字熟語', '慣用句'];
        foreach ($types as $type) {
            $urls[] = [
                'loc' => route('proverbs.by-type', $type),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }
        
        // ことわざ詳細（最新の1000件）
        Proverb::orderBy('updated_at', 'desc')
            ->limit(1000)
            ->get()
            ->each(function ($proverb) use (&$urls) {
                $urls[] = [
                    'loc' => route('proverbs.show', $proverb->id),
                    'lastmod' => $proverb->updated_at->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            });
        
        return $urls;
    }

    /**
     * 百人一首関連のURL
     */
    private function getHyakuninisshuUrls(): array
    {
        $urls = [];
        
        // 歌人
        Poet::all()->each(function ($poet) use (&$urls) {
            $urls[] = [
                'loc' => route('poets.show', $poet->id),
                'lastmod' => $poet->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        });
        
        // 季節別
        $seasons = ['春', '夏', '秋', '冬'];
        foreach ($seasons as $season) {
            $urls[] = [
                'loc' => route('hyakuninisshu.by-season', $season),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }
        
        // テーマ別
        $themes = ['恋', '自然', '人生', '季節'];
        foreach ($themes as $theme) {
            $urls[] = [
                'loc' => route('hyakuninisshu.by-theme', $theme),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }
        
        // 百人一首詳細（全件）
        Hyakuninisshu::all()->each(function ($hyakunin) use (&$urls) {
            $urls[] = [
                'loc' => route('hyakuninisshu.show', $hyakunin->id),
                'lastmod' => $hyakunin->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        });
        
        return $urls;
    }
}
