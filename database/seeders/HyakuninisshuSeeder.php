<?php
// ファイルパス: database/seeders/PoetsSeeder.php と database/seeders/HyakuninisshuSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HyakuninisshuSeeder extends Seeder
{
    public function run()
    {
        $poems = [
            [
                'number' => 1,
                'upper_phrase' => 'あきのたの',
                'lower_phrase' => 'かりほのいほの とまをあらみ わがころもでは つゆにぬれつつ',
                'reading' => 'あきのたの かりほのいほの とまをあらみ わがころもでは つゆにぬれつつ',
                'modern_translation' => '秋の田の仮庵の苫屋の目が粗いので、私の着物の袖は露に濡れ続けている。',
                'interpretation' => '秋の田での仮小屋での夜の様子を詠んだ歌。',
                'season' => '秋',
                'theme' => '自然',
                'poet_name' => '天智天皇',
            ],
            [
                'number' => 2,
                'upper_phrase' => 'はるすぎて',
                'lower_phrase' => 'なつきにけらし しろたへの ころもほすてふ あまのかぐやま',
                'reading' => 'はるすぎて なつきにけらし しろたへの ころもほすてふ あまのかぐやま',
                'modern_translation' => '春が過ぎて夏が来たらしい。白い衣を干すという天の香具山よ。',
                'interpretation' => '季節の移ろいを天香具山の白い衣で表現した歌。',
                'season' => '夏',
                'theme' => '自然',
                'poet_name' => '持統天皇',
            ],
            [
                'number' => 3,
                'upper_phrase' => 'あしびきの',
                'lower_phrase' => 'やまどりのをの しだりをの ながながしよを ひとりかもねむ',
                'reading' => 'あしびきの やまどりのをの しだりをの ながながしよを ひとりかもねむ',
                'modern_translation' => '山鳥の尾のように長い長い夜を、一人で寝ることよ。',
                'interpretation' => '恋人との別れの夜の孤独感を詠んだ歌。',
                'season' => '冬',
                'theme' => '恋',
                'poet_name' => '柿本人麻呂',
            ],
            [
                'number' => 4,
                'upper_phrase' => 'たごのうらに',
                'lower_phrase' => 'うちいでてみれば しろたへの ふじのたかねに ゆきはふりつつ',
                'reading' => 'たごのうらに うちいでてみれば しろたへの ふじのたかねに ゆきはふりつつ',
                'modern_translation' => '田子の浦に出て見ると、富士の高嶺に雪が降り続いている。',
                'interpretation' => '富士山の美しさを詠んだ代表的な自然詠。',
                'season' => '冬',
                'theme' => '自然',
                'poet_name' => '山部赤人',
            ],
            [
                'number' => 5,
                'upper_phrase' => 'おくやまに',
                'lower_phrase' => 'もみぢふみわけ なくしかの こゑきくときぞ あきはかなしき',
                'reading' => 'おくやまに もみぢふみわけ なくしかの こゑきくときぞ あきはかなしき',
                'modern_translation' => '奥山で紅葉を踏み分けて鳴く鹿の声を聞くときこそ、秋は悲しく感じる。',
                'interpretation' => '秋の情趣を鹿の声で表現した歌。',
                'season' => '秋',
                'theme' => '自然',
                'poet_name' => '猿丸大夫',
            ],
            [
                'number' => 9,
                'upper_phrase' => 'はなのいろは',
                'lower_phrase' => 'うつりにけりな いたづらに わがみよにふる ながめせしまに',
                'reading' => 'はなのいろは うつりにけりな いたづらに わがみよにふる ながめせしまに',
                'modern_translation' => '花の色は移ろってしまった。むなしく私の身の上に降る長雨を眺めている間に。',
                'interpretation' => '美貌の衰えを花に例えて詠んだ小野小町の代表作。',
                'season' => '春',
                'theme' => '人生',
                'poet_name' => '小野小町',
            ],
            [
                'number' => 17,
                'upper_phrase' => 'ちはやぶる',
                'lower_phrase' => 'かみよもきかず たつたがは からくれないに みづくくるとは',
                'reading' => 'ちはやぶる かみよもきかず たつたがは からくれないに みづくくるとは',
                'modern_translation' => '神代の昔でも聞いたことがない。竜田川が唐紅に水をくくり染めするとは。',
                'interpretation' => '竜田川の紅葉の美しさを詠んだ歌。',
                'season' => '秋',
                'theme' => '自然',
                'poet_name' => '在原業平朝臣',
            ],
        ];

        foreach ($poems as $poem) {
            // 歌人のIDを取得
            $poet = DB::table('poets')->where('name', $poem['poet_name'])->first();
            
            DB::table('hyakuninisshu')->insert([
                'number' => $poem['number'],
                'upper_phrase' => $poem['upper_phrase'],
                'lower_phrase' => $poem['lower_phrase'],
                'reading' => $poem['reading'],
                'modern_translation' => $poem['modern_translation'],
                'interpretation' => $poem['interpretation'],
                'season' => $poem['season'],
                'theme' => $poem['theme'],
                'poet_id' => $poet->id,
                'access_count' => rand(0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}