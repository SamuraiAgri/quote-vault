<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AuthorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_authors')->insert([
            // 哲学・思想
            ['name' => 'ソクラテス', 'furigana' => 'そくらてす', 'bio' => '古代ギリシャの哲学者。「無知の知」で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'プラトン', 'furigana' => 'ぷらとん', 'bio' => 'ソクラテスの弟子であり、アリストテレスの師。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アリストテレス', 'furigana' => 'ありすとてれす', 'bio' => '哲学と科学の基礎を築いた古代ギリシャの哲学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '孔子', 'furigana' => 'こうし', 'bio' => '中国の思想家で、儒教の開祖。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '老子', 'furigana' => 'ろうし', 'bio' => '道教の開祖で、「道徳経」の著者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'デカルト', 'furigana' => 'でかると', 'bio' => '「我思う、ゆえに我あり」で知られるフランスの哲学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ニーチェ', 'furigana' => 'にーちぇ', 'bio' => 'ドイツの哲学者。「超人」思想を提唱。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'カント', 'furigana' => 'かんと', 'bio' => 'ドイツの哲学者で、純粋理性批判を著した。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ヘーゲル', 'furigana' => 'へーげる', 'bio' => '弁証法で知られるドイツの哲学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ルソー', 'furigana' => 'るそー', 'bio' => '社会契約論を提唱したフランスの思想家。', 'created_at' => now(), 'updated_at' => now()],
            
            // 科学
            ['name' => 'アルベルト・アインシュタイン', 'furigana' => 'あるべると あいんしゅたいん', 'bio' => '相対性理論を提唱したドイツの物理学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アイザック・ニュートン', 'furigana' => 'あいざっく にゅーとん', 'bio' => '万有引力の法則を発見したイギリスの物理学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'チャールズ・ダーウィン', 'furigana' => 'ちゃーるず だーうぃん', 'bio' => '進化論を提唱したイギリスの博物学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'スティーブン・ホーキング', 'furigana' => 'すてぃーぶん ほーきんぐ', 'bio' => '宇宙論で多大な貢献をしたイギリスの物理学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'マリー・キュリー', 'furigana' => 'まりー きゅりー', 'bio' => 'ラジウムを発見した女性科学者。ノーベル賞を2回受賞。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ガリレオ・ガリレイ', 'furigana' => 'がりれお がりれい', 'bio' => '近代科学の基礎を築いたイタリアの天文学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ニコラ・テスラ', 'furigana' => 'にこら てすら', 'bio' => '交流電力システムを開発した発明家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'トーマス・エジソン', 'furigana' => 'とーます えじそん', 'bio' => '電球や蓄音機を発明したアメリカの発明家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'カール・セーガン', 'furigana' => 'かーる せーがん', 'bio' => '宇宙科学を大衆に広めた天文学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'リチャード・ファインマン', 'furigana' => 'りちゃーど ふぁいんまん', 'bio' => '量子力学の研究で知られるアメリカの物理学者。', 'created_at' => now(), 'updated_at' => now()],
            
            // 文学
            ['name' => 'ウィリアム・シェイクスピア', 'furigana' => 'うぃりあむ しぇいくすぴあ', 'bio' => '「ハムレット」「マクベス」などを著したイギリスの劇作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'トルストイ', 'furigana' => 'とるすとい', 'bio' => '「戦争と平和」「アンナ・カレーニナ」を著したロシアの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ドストエフスキー', 'furigana' => 'どすとえふすきー', 'bio' => '「罪と罰」「カラマーゾフの兄弟」を著したロシアの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ヘミングウェイ', 'furigana' => 'へみんぐうぇい', 'bio' => '「老人と海」でノーベル文学賞を受賞したアメリカの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'マーク・トウェイン', 'furigana' => 'まーく とうぇいん', 'bio' => '「トム・ソーヤーの冒険」の著者。アメリカの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'オスカー・ワイルド', 'furigana' => 'おすかー わいるど', 'bio' => '「ドリアン・グレイの肖像」を著したアイルランドの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ジェーン・オースティン', 'furigana' => 'じぇーん おーすてぃん', 'bio' => '「高慢と偏見」「エマ」を著したイギリスの作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アガサ・クリスティ', 'furigana' => 'あがさ くりすてぃ', 'bio' => 'ミステリー小説の女王。ポワロシリーズが有名。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '村上春樹', 'furigana' => 'むらかみ はるき', 'bio' => '「ノルウェイの森」「1Q84」を著した日本の作家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '芥川龍之介', 'furigana' => 'あくたがわ りゅうのすけ', 'bio' => '「羅生門」「河童」を著した日本の作家。', 'created_at' => now(), 'updated_at' => now()],

            // ビジネス
            ['name' => 'スティーブ・ジョブズ', 'furigana' => 'すてぃーぶ じょぶず', 'bio' => 'アップルの創業者でイノベーションの象徴。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ビル・ゲイツ', 'furigana' => 'びる げいつ', 'bio' => 'マイクロソフトの共同創業者。慈善活動家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ウォーレン・バフェット', 'furigana' => 'うぉーれん ばふぇっと', 'bio' => 'アメリカの投資家。「オマハの賢人」と呼ばれる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'イーロン・マスク', 'furigana' => 'いーろん ますく', 'bio' => 'スペースXとテスラのCEOで未来を創る企業家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'リチャード・ブランソン', 'furigana' => 'りちゃーど ぶらんそん', 'bio' => 'ヴァージン・グループの創業者で冒険家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ジェフ・ベゾス', 'furigana' => 'じぇふ べぞす', 'bio' => 'アマゾンの創業者。世界で最も裕福な人物の一人。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ジャック・マー', 'furigana' => 'じゃっく まー', 'bio' => 'アリババグループの創業者。中国の代表的企業家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ピーター・ドラッカー', 'furigana' => 'ぴーたー どらっかー', 'bio' => '「マネジメント」の父と呼ばれる経営学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'トーマス・フリードマン', 'furigana' => 'とーます ふりーどまん', 'bio' => '「フラット化する世界」を著した経済学者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アンドリュー・カーネギー', 'furigana' => 'あんどりゅー かーねぎー', 'bio' => 'アメリカの鉄鋼王。慈善活動で名を残す。', 'created_at' => now(), 'updated_at' => now()],

            // 政治
            ['name' => 'マハトマ・ガンジー', 'furigana' => 'まはとま がんじー', 'bio' => 'インド独立運動の指導者。非暴力主義を提唱。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ウィンストン・チャーチル', 'furigana' => 'うぃんすとん ちゃーちる', 'bio' => 'イギリスの元首相。第二次世界大戦での指導力で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'マーティン・ルーサー・キングJr.', 'furigana' => 'まーてぃん るーさー きんぐ', 'bio' => 'アメリカの公民権運動指導者。「I Have a Dream」で有名。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ジョン・F・ケネディ', 'furigana' => 'じょん えふ けねでぃ', 'bio' => 'アメリカ第35代大統領。カリスマ性と冷戦時代の指導力で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'バラク・オバマ', 'furigana' => 'ばらく おばま', 'bio' => 'アメリカ初のアフリカ系大統領。ノーベル平和賞を受賞。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'マルクス', 'furigana' => 'まるくす', 'bio' => 'ドイツの哲学者。共産主義思想の基礎を築く。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'チェ・ゲバラ', 'furigana' => 'ちぇ げばら', 'bio' => 'キューバ革命の英雄。社会主義思想で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ナポレオン・ボナパルト', 'furigana' => 'なぽれおん ぼなぱると', 'bio' => 'フランスの軍人・政治家。ヨーロッパ史に大きな影響を与える。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アンネ・フランク', 'furigana' => 'あんね ふらんく', 'bio' => '第二次世界大戦中の日記で知られるユダヤ人少女。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'エイブラハム・リンカーン', 'furigana' => 'えいぶらはむ りんかーん', 'bio' => 'アメリカ第16代大統領。奴隷解放宣言を行う。', 'created_at' => now(), 'updated_at' => now()],

            // 芸術
            ['name' => 'ミケランジェロ', 'furigana' => 'みけらんじぇろ', 'bio' => 'ルネサンス時代のイタリアの芸術家。ダビデ像で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'レオナルド・ダ・ヴィンチ', 'furigana' => 'れおなるど だ う゛ぃんち', 'bio' => 'ルネサンスを代表する芸術家。「モナリザ」の作者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ピカソ', 'furigana' => 'ぴかそ', 'bio' => '20世紀を代表するスペインの画家。キュビズムの創始者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ゴッホ', 'furigana' => 'ごっほ', 'bio' => '後期印象派を代表するオランダの画家。「ひまわり」で有名。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'クロード・モネ', 'furigana' => 'くろーど もね', 'bio' => '印象派のフランス人画家。「印象・日の出」で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'サルバドール・ダリ', 'furigana' => 'さるばどーる だり', 'bio' => 'スペインのシュルレアリスムの巨匠。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'バッハ', 'furigana' => 'ばっは', 'bio' => 'バロック音楽を代表するドイツの作曲家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'モーツァルト', 'furigana' => 'もーつぁると', 'bio' => 'クラシック音楽の巨匠。オーストリアの作曲家。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ベートーベン', 'furigana' => 'べーとーべん', 'bio' => 'ドイツの作曲家。交響曲第9番「合唱付き」で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'フレディ・マーキュリー', 'furigana' => 'ふれでぃ まーきゅりー', 'bio' => 'クイーンのボーカリスト。伝説的な音楽家。', 'created_at' => now(), 'updated_at' => now()],

            // スポーツ
            ['name' => 'マイケル・ジョーダン', 'furigana' => 'まいける じょーだん', 'bio' => 'バスケットボールの伝説的選手。シカゴ・ブルズのスター。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'セリーナ・ウィリアムズ', 'furigana' => 'せりーな うぃりあむず', 'bio' => 'アメリカの女子テニス選手。グランドスラム優勝者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'イチロー', 'furigana' => 'いちろう', 'bio' => '日本人MLBプレイヤー。驚異のヒット記録保持者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '大谷翔平', 'furigana' => 'おおたに しょうへい', 'bio' => '現役の日本人メジャーリーガー。ピッチャー・バッター二刀流。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'クリスティアーノ・ロナウド', 'furigana' => 'くりすてぃあーの ろなうど', 'bio' => 'ポルトガルのサッカー選手。国際的なスター選手。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'リオネル・メッシ', 'furigana' => 'りおねる めっし', 'bio' => 'アルゼンチンのサッカー選手。数々の記録保持者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'トム・ブレイディ', 'furigana' => 'とむ ぶれいでぃ', 'bio' => 'アメリカのNFL選手。歴代最高のクォーターバック。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ウサイン・ボルト', 'furigana' => 'うさいん ぼると', 'bio' => 'ジャマイカの陸上選手。100m走の世界記録保持者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ナディア・コマネチ', 'furigana' => 'なでぃあ こまねち', 'bio' => 'ルーマニアの体操選手。初の10点満点を獲得。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アンドレ・アガシ', 'furigana' => 'あんどれ あがし', 'bio' => '元プロテニス選手で、数々の大会で活躍。', 'created_at' => now(), 'updated_at' => now()],

            // 宗教
            ['name' => 'イエス・キリスト', 'furigana' => 'いえす きりすと', 'bio' => 'キリスト教の中心的人物で神の子とされる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ブッダ', 'furigana' => 'ぶっだ', 'bio' => '仏教の開祖であり、悟りを開いた人物。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ムハンマド', 'furigana' => 'むはんまど', 'bio' => 'イスラム教の預言者であり、クルアーンの啓示を受けた。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'マザー・テレサ', 'furigana' => 'まざー てれさ', 'bio' => 'カトリック修道女。貧困層への奉仕でノーベル平和賞を受賞。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '聖フランシスコ', 'furigana' => 'せい ふらんしすこ', 'bio' => 'カトリックの聖人。貧者への奉仕で知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ダライ・ラマ14世', 'furigana' => 'だらい らま じゅうよんせい', 'bio' => 'チベット仏教の最高指導者。平和の象徴として知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アルバート・シュヴァイツァー', 'furigana' => 'あるばーと しゅゔぁいつぁー', 'bio' => 'キリスト教信仰に基づく奉仕活動でノーベル平和賞を受賞。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ジョン・ウェスリー', 'furigana' => 'じょん うぇすりー', 'bio' => 'メソジスト運動の創始者。信仰と実践の統一を説く。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ラビ・サックス', 'furigana' => 'らび さっくす', 'bio' => '現代ユダヤ教の思想家であり、教育者。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'エックハルト・トール', 'furigana' => 'えっくはると とーる', 'bio' => '精神性を重視した思想家。「今ここ」を説く。', 'created_at' => now(), 'updated_at' => now()],

            // 現代のアイコン
            ['name' => 'オプラ・ウィンフリー', 'furigana' => 'おぷら うぃんふりー', 'bio' => 'アメリカのテレビ司会者で慈善家。影響力のある人物。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'レディー・ガガ', 'furigana' => 'れでぃー がが', 'bio' => 'アメリカの歌手・女優。個性あふれるスタイルで知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'テイラー・スウィフト', 'furigana' => 'ていらー すうぃふと', 'bio' => 'アメリカの歌手・作曲家。多くのヒット曲を生む。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BTS', 'furigana' => 'びーてぃーえす', 'bio' => '韓国の音楽グループ。世界的な人気を誇る。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'キアヌ・リーブス', 'furigana' => 'きあぬ りーぶす', 'bio' => 'ハリウッドの俳優。「マトリックス」シリーズで有名。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'エマ・ワトソン', 'furigana' => 'えま わとそん', 'bio' => 'イギリスの女優。「ハリー・ポッター」シリーズで知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ウィル・スミス', 'furigana' => 'うぃる すみす', 'bio' => 'アメリカの俳優・歌手。「メン・イン・ブラック」で有名。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '小泉進次郎', 'furigana' => 'こいずみ しんじろう', 'bio' => '日本の政治家。環境問題や若者支援で注目される。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ムンバイの貧困女性活動家', 'furigana' => 'むんばいのひんこんじょせいかつどうか', 'bio' => 'インドの女性活動家。貧困問題解決のための取り組みで知られる。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ボブ・ディラン', 'furigana' => 'ぼぶ でぃらん', 'bio' => 'アメリカの音楽家。ノーベル文学賞を受賞。', 'created_at' => now(), 'updated_at' => now()],

            // 架空の著者
            ['name' => 'ダース・ベイダー', 'furigana' => 'だーす べいだー', 'bio' => 'スター・ウォーズシリーズのキャラクター。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ハリー・ポッター', 'furigana' => 'はりー ぽったー', 'bio' => '魔法の世界で冒険する少年。「ハリー・ポッター」シリーズの主人公。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ゴルゴ13', 'furigana' => 'ごるご さーてぃーん', 'bio' => '日本の漫画作品「ゴルゴ13」の主人公。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ルパン三世', 'furigana' => 'るぱん さんせい', 'bio' => 'モンキー・パンチ作の漫画キャラクター。泥棒紳士として活躍。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'モンキー・D・ルフィ', 'furigana' => 'もんきー でぃー るふぃ', 'bio' => '漫画「ワンピース」の主人公。海賊王を目指す少年。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'シェルロック・ホームズ', 'furigana' => 'しぇるろっく ほーむず', 'bio' => 'アーサー・コナン・ドイルの推理小説に登場する名探偵。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'デスノートのL', 'furigana' => 'ですのーとの える', 'bio' => '「デスノート」に登場する名探偵キャラクター。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '手塚治虫', 'furigana' => 'てづか おさむ', 'bio' => '日本の漫画家、アニメーター。代表作は「鉄腕アトム」や「ブラック・ジャック」。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ヘレン・ケラー', 'furigana' => 'へれん けらー', 'bio' => '盲聾者でありながら、作家、講演家として活躍したアメリカの人物。', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ウォルト・ディズニー', 'furigana' => 'うぉると でぃずにー', 'bio' => 'ディズニーの創業者であり、アニメーション映画の先駆者。', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}