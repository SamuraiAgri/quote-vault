<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'm_authors';

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'author_id');
    }
}
