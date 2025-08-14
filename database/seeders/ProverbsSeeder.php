<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProverbsSeeder extends Seeder
{
    public function run()
    {
        // CSVファイルからデータを読み込む
        $csvFiles = [
            database_path('data/kannyouku.csv'),
            database_path('data/kotowaza.csv'),
            database_path('data/yojijukugo.csv'),
        ];

        $proverbsData = [];

        foreach ($csvFiles as $csvFile) {
            if (file_exists($csvFile)) {
                $csv = array_map('str_getcsv', file($csvFile));
                $header = array_shift($csv); // ヘッダー行を削除
                
                foreach ($csv as $row) {
                    if (count($row) >= 6) { // 必要な列数があることを確認
                        $proverbsData[] = [
                            'word' => trim($row[0]),
                            'reading' => trim($row[1]),
                            'meaning' => trim($row[2]),
                            'example' => trim($row[3]),
                            'type' => trim($row[4]),
                            'category_id' => (int)trim($row[5]),
                            'access_count' => 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            } else {
                echo "Warning: CSV file not found: {$csvFile}\n";
            }
        }

        // データが存在する場合のみ挿入
        if (!empty($proverbsData)) {
            // 一括挿入でパフォーマンスを向上
            $chunks = array_chunk($proverbsData, 1000);
            foreach ($chunks as $chunk) {
                DB::table('t_proverbs')->insert($chunk);
            }
            
            echo "ProverbsSeeder: " . count($proverbsData) . " records inserted successfully.\n";
        } else {
            echo "ProverbsSeeder: No data found in CSV files.\n";
        }
    }
}