<?php
// ファイルパス: database/seeders/PoetsSeeder.php と database/seeders/HyakuninisshuSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoetsSeeder extends Seeder
{
    public function run()
    {
        $poets = [
            ['name' => '天智天皇', 'reading' => 'てんじてんのう', 'biography' => '第38代天皇。大化の改新を推進した。', 'period' => '飛鳥時代'],
            ['name' => '持統天皇', 'reading' => 'じとうてんのう', 'biography' => '第41代天皇。天武天皇の皇后。', 'period' => '飛鳥時代'],
            ['name' => '柿本人麻呂', 'reading' => 'かきのもとのひとまろ', 'biography' => '歌聖と呼ばれる万葉集の代表的歌人。', 'period' => '飛鳥時代'],
            ['name' => '山部赤人', 'reading' => 'やまべのあかひと', 'biography' => '万葉集の代表的歌人の一人。自然詠に優れる。', 'period' => '奈良時代'],
            ['name' => '猿丸大夫', 'reading' => 'さるまるたゆう', 'biography' => '伝説的な歌人。実在を疑問視する説もある。', 'period' => '奈良時代'],
            ['name' => '中納言家持', 'reading' => 'ちゅうなごんやかもち', 'biography' => '大伴家持。万葉集の編纂に関わった。', 'period' => '奈良時代'],
            ['name' => '安倍右大臣', 'reading' => 'あべのうだいじん', 'biography' => '安倍仲麻呂。遣唐使として唐に渡った。', 'period' => '奈良時代'],
            ['name' => '喜撰法師', 'reading' => 'きせんほうし', 'biography' => '平安初期の僧侶・歌人。', 'period' => '平安時代'],
            ['name' => '小野小町', 'reading' => 'おののこまち', 'biography' => '絶世の美女と謳われた女流歌人。', 'period' => '平安時代'],
            ['name' => '僧正遍昭', 'reading' => 'そうじょうへんじょう', 'biography' => '在原業平の父。僧となった歌人。', 'period' => '平安時代'],
            ['name' => '在原業平朝臣', 'reading' => 'ありわらのなりひらあそん', 'biography' => '伊勢物語の主人公とされる歌人。', 'period' => '平安時代'],
            ['name' => '参議篁', 'reading' => 'さんぎたかむら', 'biography' => '小野篁。学者・政治家・歌人。', 'period' => '平安時代'],
            ['name' => '陽成院', 'reading' => 'ようぜいいん', 'biography' => '第57代天皇。', 'period' => '平安時代'],
            ['name' => '河原左大臣', 'reading' => 'かわらのさだいじん', 'biography' => '源融。光源氏のモデルの一人とされる。', 'period' => '平安時代'],
            ['name' => '光孝天皇', 'reading' => 'こうこうてんのう', 'biography' => '第58代天皇。', 'period' => '平安時代'],
            ['name' => '中納言行平', 'reading' => 'ちゅうなごんゆきひら', 'biography' => '在原行平。業平の兄。', 'period' => '平安時代'],
            ['name' => '在原元方', 'reading' => 'ありわらのもとかた', 'biography' => '在原行平の息子。', 'period' => '平安時代'],
            ['name' => '藤原敏行朝臣', 'reading' => 'ふじわらのとしゆきあそん', 'biography' => '古今和歌集の撰者の一人。', 'period' => '平安時代'],
            ['name' => '伊勢', 'reading' => 'いせ', 'biography' => '女流歌人。恋歌に優れる。', 'period' => '平安時代'],
            ['name' => '元良親王', 'reading' => 'もとよししんのう', 'biography' => '陽成天皇の第一皇子。', 'period' => '平安時代'],
        ];

        foreach ($poets as $poet) {
            DB::table('poets')->insert([
                'name' => $poet['name'],
                'reading' => $poet['reading'],
                'biography' => $poet['biography'],
                'period' => $poet['period'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}