<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProverbCategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_proverb_categories')->insert([
            ['name' => '努力・勤勉', 'description' => '努力や勤勉さに関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '人間関係', 'description' => '人とのつながりや関係に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '知恵・学問', 'description' => '知恵や学問に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '成功・失敗', 'description' => '成功や失敗に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '時間・機会', 'description' => '時間や機会に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '自然・天候', 'description' => '自然や天候に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '金銭・経済', 'description' => 'お金や経済に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '健康・生活', 'description' => '健康や日常生活に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '愛情・恋愛', 'description' => '愛情や恋愛に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '道徳・教訓', 'description' => '道徳や教訓に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '美・芸術', 'description' => '美しさや芸術に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '勇気・決断', 'description' => '勇気や決断力に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '協力・団結', 'description' => '協力や団結に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '忍耐・辛抱', 'description' => '忍耐力や辛抱に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '変化・成長', 'description' => '変化や成長に関することわざ・四字熟語', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}