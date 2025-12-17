<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Quote;
use App\Models\Proverb;
use App\Models\Hyakuninisshu;
use App\Models\LargeCategory;

/**
 * キャッシュサービス
 * パフォーマンス改善：頻繁にアクセスされるデータをキャッシュ
 */
class CacheService
{
    // キャッシュのTTL（秒）
    private const POPULAR_CACHE_TTL = 3600;      // 1時間
    private const RECENT_CACHE_TTL = 300;        // 5分
    private const CATEGORY_CACHE_TTL = 86400;    // 24時間

    /**
     * 人気の名言を取得（キャッシュ付き）
     */
    public function getPopularQuotes(int $limit = 6)
    {
        return Cache::remember('popular_quotes_' . $limit, self::POPULAR_CACHE_TTL, function () use ($limit) {
            return Quote::popular()
                        ->with('author')
                        ->limit($limit)
                        ->get();
        });
    }

    /**
     * 最近アクセスされた名言を取得（キャッシュ付き）
     */
    public function getRecentQuotes(int $limit = 6)
    {
        return Cache::remember('recent_quotes_' . $limit, self::RECENT_CACHE_TTL, function () use ($limit) {
            return Quote::recentlyAccessed()
                        ->with('author')
                        ->limit($limit)
                        ->get();
        });
    }

    /**
     * 人気のことわざを取得（キャッシュ付き）
     */
    public function getPopularProverbs(int $limit = 6)
    {
        return Cache::remember('popular_proverbs_' . $limit, self::POPULAR_CACHE_TTL, function () use ($limit) {
            try {
                return Proverb::popular()
                              ->with('category')
                              ->limit($limit)
                              ->get();
            } catch (\Exception $e) {
                return collect();
            }
        });
    }

    /**
     * 人気の百人一首を取得（キャッシュ付き）
     */
    public function getPopularPoems(int $limit = 6)
    {
        return Cache::remember('popular_poems_' . $limit, self::POPULAR_CACHE_TTL, function () use ($limit) {
            try {
                return Hyakuninisshu::popular()
                                    ->with('poet')
                                    ->limit($limit)
                                    ->get();
            } catch (\Exception $e) {
                return collect();
            }
        });
    }

    /**
     * 大カテゴリ一覧を取得（キャッシュ付き）
     */
    public function getLargeCategories()
    {
        return Cache::remember('large_categories', self::CATEGORY_CACHE_TTL, function () {
            return LargeCategory::all();
        });
    }

    /**
     * キャッシュをクリア（データ更新時に呼び出す）
     */
    public function clearAllCache(): void
    {
        Cache::forget('popular_quotes_6');
        Cache::forget('recent_quotes_6');
        Cache::forget('popular_proverbs_6');
        Cache::forget('popular_poems_6');
        Cache::forget('large_categories');
    }

    /**
     * 名言関連のキャッシュをクリア
     */
    public function clearQuoteCache(): void
    {
        Cache::forget('popular_quotes_6');
        Cache::forget('recent_quotes_6');
    }
}
