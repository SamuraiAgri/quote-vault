<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 't_quotes';

    // マスアサインメントを許可するカラムを定義
    protected $fillable = [
        'quote_text',
        'quote_furigana',
        'author_id',
        'category_id',
        'last_accessed_at',
        'popular_score',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
        // アクセス数を増やすメソッド
    public function incrementAccessCount()
    {
        $this->increment('popular_score');
        $this->update(['last_accessed_at' => now()]);
    }

    // 人気順スコープ
    public function scopePopular($query)
    {
        return $query->orderBy('popular_score', 'desc');
    }

    // 最近アクセスされたもののスコープ
    public function scopeRecentlyAccessed($query)
    {
        return $query->whereNotNull('last_accessed_at')
                    ->orderBy('last_accessed_at', 'desc');
    }

    // 検索スコープ
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('quote_text', 'like', "%{$keyword}%")
              ->orWhereHas('author', function($authorQuery) use ($keyword) {
                  $authorQuery->where('name', 'like', "%{$keyword}%");
              });
        });
    }
}
