<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LargeCategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_largecategories')->insert([
            ['name' => '人生と哲学', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ビジネスとリーダーシップ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '愛と人間関係', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '教育と学び', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '科学と技術', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '芸術と創造性', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'スポーツと挑戦', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '宗教と精神性', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '自然と環境', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ユーモアとウィット', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
