<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proverb extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'reading',
        'meaning',
        'example',
        'type',
        'category_id',
        'access_count',
        'last_accessed_at',
    ];

    protected $dates = [
        'last_accessed_at',
    ];

    public function category()
    {
        return $this->belongsTo(ProverbCategory::class, 'category_id');
    }

    // アクセス数を増やすメソッド
    public function incrementAccessCount()
    {
        $this->increment('access_count');
        $this->update(['last_accessed_at' => now()]);
    }

    // 人気順スコープ
    public function scopePopular($query)
    {
        return $query->orderBy('access_count', 'desc');
    }

    // 最近アクセスされたもののスコープ
    public function scopeRecentlyAccessed($query)
    {
        return $query->whereNotNull('last_accessed_at')
                    ->orderBy('last_accessed_at', 'desc');
    }

    // 種類別スコープ
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // 検索スコープ
    public function scopeSearch($query, $keyword)
    {
        return $query->whereRaw('MATCH(word, reading, meaning) AGAINST(? IN NATURAL LANGUAGE MODE)', [$keyword]);
    }
}