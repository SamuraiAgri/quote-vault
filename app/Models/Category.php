<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'm_categories';

    public function largeCategory()
    {
        return $this->belongsTo(LargeCategory::class, 'largecategory_id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'category_id');
    }
}
