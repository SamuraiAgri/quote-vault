<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_categories')->insert([
            ['largecategory_id' => 1, 'name' => '幸福', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 1, 'name' => '成功', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 1, 'name' => '挑戦', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 1, 'name' => '感謝', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 1, 'name' => '逆境', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 1, 'name' => '哲学', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => 'リーダーシップ', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => 'チームワーク', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => '目標設定', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => '起業', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => '効率化', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 2, 'name' => '希望', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 3, 'name' => '愛', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 3, 'name' => '友情', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 3, 'name' => '家族', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 3, 'name' => '信頼', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 3, 'name' => '絆', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 4, 'name' => '学び', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 4, 'name' => '知識', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 4, 'name' => '創造性', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 4, 'name' => '進歩', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 4, 'name' => '教養', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 5, 'name' => '宇宙', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 5, 'name' => '発明', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 5, 'name' => '技術革新', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 5, 'name' => '科学', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 5, 'name' => '未来', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 6, 'name' => '表現', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 6, 'name' => '音楽', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 6, 'name' => '文学', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 6, 'name' => '絵画', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 6, 'name' => '想像力', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 7, 'name' => '勝利', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 7, 'name' => 'チームワーク', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 7, 'name' => '忍耐', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 7, 'name' => '努力', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 7, 'name' => '目標達成', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 8, 'name' => '信仰', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 8, 'name' => '祈り', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 8, 'name' => '魂', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 8, 'name' => '教え', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 8, 'name' => '悟り', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 9, 'name' => '自然', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 9, 'name' => '地球', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 9, 'name' => '生命', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 9, 'name' => '環境', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 9, 'name' => '調和', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 10, 'name' => 'ユーモア', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 10, 'name' => '皮肉', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 10, 'name' => '機知', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 10, 'name' => '笑い', 'created_at' => now(), 'updated_at' => now()],
            ['largecategory_id' => 10, 'name' => '風刺', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
