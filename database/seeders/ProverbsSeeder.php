<?php
// ファイルパス: database/seeders/ProverbCategoriesSeeder.php と database/seeders/ProverbsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProverbsSeeder extends Seeder
{
    public function run()
    {
        $proverbs = [
            // ことわざ
            [
                'word' => '継続は力なり',
                'reading' => 'けいぞくはちからなり',
                'meaning' => '何事も続けることで必ず力となり、成果を生む。',
                'example' => '毎日少しずつでも勉強を続けていれば、継続は力なりで、必ず実力がつくものだ。',
                'type' => 'ことわざ',
                'category_id' => 1, // 努力・勤勉
            ],
            [
                'word' => '急がば回れ',
                'reading' => 'いそがばまわれ',
                'meaning' => '急ぐときこそ、確実で安全な方法を選ぶべきである。',
                'example' => '試験勉強は急がば回れで、基礎から丁寧に学習した方が良い。',
                'type' => 'ことわざ',
                'category_id' => 5, // 時間・機会
            ],
            [
                'word' => '親しき仲にも礼儀あり',
                'reading' => 'したしきなかにもれいぎあり',
                'meaning' => '親しい間柄でも、礼儀を忘れてはいけない。',
                'example' => '友達とはいえ、親しき仲にも礼儀ありで、最低限のマナーは守るべきだ。',
                'type' => 'ことわざ',
                'category_id' => 2, // 人間関係
            ],
            [
                'word' => '石の上にも三年',
                'reading' => 'いしのうえにもさんねん',
                'meaning' => 'つらいことでも我慢して続ければ、必ず成果が出る。',
                'example' => '新しい仕事は大変だが、石の上にも三年と言うし、もう少し頑張ってみよう。',
                'type' => 'ことわざ',
                'category_id' => 1, // 努力・勤勉
            ],
            [
                'word' => '知識は力なり',
                'reading' => 'ちしきはちからなり',
                'meaning' => '知識を身につけることは、人生を切り開く大きな力となる。',
                'example' => '彼は勉強熱心で、知識は力なりを体現している。',
                'type' => 'ことわざ',
                'category_id' => 3, // 知恵・学問
            ],

            // 四字熟語
            [
                'word' => '一期一会',
                'reading' => 'いちごいちえ',
                'meaning' => '一生に一度の出会い。その時を大切にすること。',
                'example' => '今日の出会いは一期一会として、心を込めてもてなそう。',
                'type' => '四字熟語',
                'category_id' => 2, // 人間関係
            ],
            [
                'word' => '切磋琢磨',
                'reading' => 'せっさたくま',
                'meaning' => '互いに励まし合い、競い合って向上すること。',
                'example' => 'チームメイトと切磋琢磨しながら、技術を向上させた。',
                'type' => '四字熟語',
                'category_id' => 1, // 努力・勤勉
            ],
            [
                'word' => '温故知新',
                'reading' => 'おんこちしん',
                'meaning' => '古いことを研究して、新しい知識や道理を見つけ出すこと。',
                'example' => '古典文学を学ぶことで、温故知新の精神を養う。',
                'type' => '四字熟語',
                'category_id' => 3, // 知恵・学問
            ],
            [
                'word' => '七転八起',
                'reading' => 'しちてんはっき',
                'meaning' => '何度失敗しても諦めずに立ち上がること。',
                'example' => '事業は失敗したが、七転八起の精神で再挑戦する。',
                'type' => '四字熟語',
                'category_id' => 4, // 成功・失敗
            ],
            [
                'word' => '電光石火',
                'reading' => 'でんこうせっか',
                'meaning' => '動作や行動が非常に素早いこと。',
                'example' => '彼の判断は電光石火で、チャンスを逃さない。',
                'type' => '四字熟語',
                'category_id' => 5, // 時間・機会
            ],

            // 慣用句
            [
                'word' => '猫に小判',
                'reading' => 'ねこにこばん',
                'meaning' => '価値の分からない者に貴重なものを与えても無駄であること。',
                'example' => '彼に高級な本をプレゼントしても猫に小判だろう。',
                'type' => '慣用句',
                'category_id' => 3, // 知恵・学問
            ],
            [
                'word' => '目から鱗が落ちる',
                'reading' => 'めからうろこがおちる',
                'meaning' => '急に物事の真相や本質が理解できるようになること。',
                'example' => '先生の説明を聞いて、目から鱗が落ちる思いだった。',
                'type' => '慣用句',
                'category_id' => 3, // 知恵・学問
            ],
            [
                'word' => '足を引っ張る',
                'reading' => 'あしをひっぱる',
                'meaning' => '他人の邪魔をしたり、妨害したりすること。',
                'example' => 'チームワークが大切なのに、彼はいつも足を引っ張る。',
                'type' => '慣用句',
                'category_id' => 2, // 人間関係
            ],
            [
                'word' => '雲をつかむような話',
                'reading' => 'くもをつかむようなはなし',
                'meaning' => '内容が曖昧で、実現の見通しが立たない話。',
                'example' => '彼の計画は雲をつかむような話で信用できない。',
                'type' => '慣用句',
                'category_id' => 4, // 成功・失敗
            ],
            [
                'word' => '時は金なり',
                'reading' => 'じはかねなり',
                'meaning' => '時間はお金と同じように貴重なものである。',
                'example' => '時は金なりというから、無駄な会議は控えよう。',
                'type' => 'ことわざ',
                'category_id' => 5, // 時間・機会
            ],
        ];

        foreach ($proverbs as $proverb) {
            DB::table('proverbs')->insert([
                'word' => $proverb['word'],
                'reading' => $proverb['reading'],
                'meaning' => $proverb['meaning'],
                'example' => $proverb['example'],
                'type' => $proverb['type'],
                'category_id' => $proverb['category_id'],
                'access_count' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}