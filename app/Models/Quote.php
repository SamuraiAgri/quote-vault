<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAccessTracking;

class Quote extends Model
{
    use HasFactory, HasAccessTracking;

    protected $table = 't_quotes';

    // マスアサインメントを許可するカラムを定義
    protected $fillable = [
        'quote_text',
        'quote_furigana',
        'author_id',
        'category_id',
        'last_accessed_at',
        'access_count',
    ];

    protected $dates = [
        'last_accessed_at',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * 検索スコープ
     * セキュリティ改善: パラメータバインディングを使用
     */
    public function scopeSearch($query, string $keyword)
    {
        $searchTerm = '%' . addcslashes($keyword, '%_') . '%';
        
        return $query->where(function($q) use ($searchTerm) {
            $q->where('quote_text', 'like', $searchTerm)
              ->orWhere('quote_furigana', 'like', $searchTerm)
              ->orWhereHas('author', function($authorQuery) use ($searchTerm) {
                  $authorQuery->where('name', 'like', $searchTerm)
                              ->orWhere('furigana', 'like', $searchTerm);
              });
        });
    }
}
