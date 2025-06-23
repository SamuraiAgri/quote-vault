<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProverbCategory extends Model
{
    use HasFactory;
    protected $table = 'm_proverb_categories';
    protected $fillable = [
        'name',
        'description',
    ];

    public function proverbs()
    {
        return $this->hasMany(Proverb::class, 'category_id');
    }
}