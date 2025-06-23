<?php
// ファイルパス: app/Models/Poet.php と app/Models/Hyakuninisshu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poet extends Model
{
    use HasFactory;
    protected $table = 'm_poets';
    protected $fillable = [
        'name',
        'reading',
        'biography',
        'period',
    ];

    public function hyakuninisshu()
    {
        return $this->hasMany(Hyakuninisshu::class);
    }
}