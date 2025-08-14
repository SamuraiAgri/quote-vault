<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuotesSeeder extends Seeder
{
    public function run()
    {
        // CSVファイルからデータを読み込む
        $csvFiles = [];
        for ($i = 1; $i <= 8; $i++) {
            $csvFiles[] = database_path("data/quotes_{$i}.csv");
        }

        $quotesData = [];

        foreach ($csvFiles as $csvFile) {
            if (file_exists($csvFile)) {
                $csv = array_map('str_getcsv', file($csvFile));
                $header = array_shift($csv); // ヘッダー行を削除
                
                foreach ($csv as $row) {
                    if (count($row) >= 4) { // 必要な列数があることを確認
                        // 著者とカテゴリのIDを取得
                        $authorId = DB::table('m_authors')->where('name', trim($row[0]))->value('id');
                        $categoryId = DB::table('m_categories')->where('name', trim($row[3]))->value('id');
                        
                        if ($authorId && $categoryId) {
                            $quotesData[] = [
                                'author_id' => $authorId,
                                'quote_text' => trim($row[1]),
                                'quote_furigana' => trim($row[2]),
                                'category_id' => $categoryId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        } else {
                            echo "Warning: Author '" . trim($row[0]) . "' or Category '" . trim($row[3]) . "' not found\n";
                        }
                    }
                }
            } else {
                echo "Warning: CSV file not found: {$csvFile}\n";
            }
        }

        // データが存在する場合のみ挿入
        if (!empty($quotesData)) {
            // 一括挿入でパフォーマンスを向上
            $chunks = array_chunk($quotesData, 1000);
            foreach ($chunks as $chunk) {
                DB::table('t_quotes')->insert($chunk);
            }
            
            echo "QuotesSeeder: " . count($quotesData) . " records inserted successfully.\n";
        } else {
            echo "QuotesSeeder: No valid data found in CSV files.\n";
        }
    }
}