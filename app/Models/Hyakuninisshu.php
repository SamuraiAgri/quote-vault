<?php
// ファイルパス: app/Models/Poet.php と app/Models/Hyakuninisshu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hyakuninisshu extends Model
{
    use HasFactory;

    protected $table = 'hyakuninisshu';

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

    // 番号順スコープ
    public function scopeByNumber($query)
    {
        return $query->orderBy('number');
    }

    // 季節別スコープ
    public function scopeBySeason($query, $season)
    {
        return $query->where('season', $season);
    }

    // テーマ別スコープ
    public function scopeByTheme($query, $theme)
    {
        return $query->where('theme', $theme);
    }

    // 歌人別スコープ
    public function scopeByPoet($query, $poetId)
    {
        return $query->where('poet_id', $poetId);
    }

    // 検索スコープ
    public function scopeSearch($query, $keyword)
    {
        return $query->whereRaw('MATCH(upper_phrase, lower_phrase, reading, modern_translation) AGAINST(? IN NATURAL LANGUAGE MODE)', [$keyword]);
    }

    // 完全な歌を取得するアクセサ
    public function getFullPoemAttribute()
    {
        return $this->upper_phrase . ' ' . $this->lower_phrase;
    }
}