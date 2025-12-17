<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAccessTracking;

class Proverb extends Model
{
    use HasFactory, HasAccessTracking;

    protected $table = 't_proverbs';
    
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

    /**
     * 種類別スコープ
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * 検索スコープ
     * フルテキスト検索が失敗した場合はLIKE検索にフォールバック
     */
    public function scopeSearch($query, string $keyword)
    {
        try {
            return $query->whereRaw(
                'MATCH(word, reading, meaning) AGAINST(? IN NATURAL LANGUAGE MODE)', 
                [$keyword]
            );
        } catch (\Exception $e) {
            // フルテキスト検索が使えない場合はLIKE検索
            $searchTerm = '%' . addcslashes($keyword, '%_') . '%';
            return $query->where(function($q) use ($searchTerm) {
                $q->where('word', 'like', $searchTerm)
                  ->orWhere('reading', 'like', $searchTerm)
                  ->orWhere('meaning', 'like', $searchTerm);
            });
        }
    }
}