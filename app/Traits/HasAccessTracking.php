<?php

namespace App\Traits;

/**
 * アクセス追跡機能を提供するTrait
 * DRY原則：Quote, Proverb, Hyakuninisshuで共通するコードを集約
 */
trait HasAccessTracking
{
    /**
     * アクセス数をインクリメントし、最終アクセス日時を更新
     * 
     * @return void
     */
    public function incrementAccessCount(): void
    {
        $this->increment('access_count');
        $this->update(['last_accessed_at' => now()]);
    }

    /**
     * 人気順（アクセス数降順）スコープ
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('access_count');
    }

    /**
     * 最近アクセスされた順スコープ
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentlyAccessed($query)
    {
        return $query->whereNotNull('last_accessed_at')
                     ->orderByDesc('last_accessed_at');
    }

    /**
     * アクセス数が一定以上のものを取得
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $minCount
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopularAbove($query, int $minCount)
    {
        return $query->where('access_count', '>=', $minCount);
    }
}
