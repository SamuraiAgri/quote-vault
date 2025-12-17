<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAccessTracking;

class Hyakuninisshu extends Model
{
    use HasFactory, HasAccessTracking;

    protected $table = 't_hyakuninisshu';

    protected $fillable = [
        'number',
        'upper_phrase',
        'lower_phrase',
        'reading',
        'modern_translation',
        'interpretation',
        'season',
        'theme',
        'poet_id',
        'access_count',
        'last_accessed_at',
    ];

    protected $dates = [
        'last_accessed_at',
    ];

    public function poet()
    {
        return $this->belongsTo(Poet::class);
    }

    /**
     * 番号順スコープ
     */
    public function scopeByNumber($query)
    {
        return $query->orderBy('number');
    }

    /**
     * 季節別スコープ
     */
    public function scopeBySeason($query, string $season)
    {
        return $query->where('season', $season);
    }

    /**
     * テーマ別スコープ
     */
    public function scopeByTheme($query, string $theme)
    {
        return $query->where('theme', $theme);
    }

    /**
     * 歌人別スコープ
     */
    public function scopeByPoet($query, int $poetId)
    {
        return $query->where('poet_id', $poetId);
    }

    /**
     * 検索スコープ
     * フルテキスト検索が失敗した場合はLIKE検索にフォールバック
     */
    public function scopeSearch($query, string $keyword)
    {
        try {
            return $query->whereRaw(
                'MATCH(upper_phrase, lower_phrase, reading, modern_translation) AGAINST(? IN NATURAL LANGUAGE MODE)', 
                [$keyword]
            );
        } catch (\Exception $e) {
            $searchTerm = '%' . addcslashes($keyword, '%_') . '%';
            return $query->where(function($q) use ($searchTerm) {
                $q->where('upper_phrase', 'like', $searchTerm)
                  ->orWhere('lower_phrase', 'like', $searchTerm)
                  ->orWhere('reading', 'like', $searchTerm)
                  ->orWhere('modern_translation', 'like', $searchTerm);
            });
        }
    }

    /**
     * 完全な歌を取得するアクセサ
     */
    public function getFullPoemAttribute(): string
    {
        return $this->upper_phrase . ' ' . $this->lower_phrase;
    }
}