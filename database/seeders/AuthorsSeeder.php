<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AuthorsSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('data/authors.csv');
        
        if (!file_exists($csvFile)) {
            echo "Warning: CSV file not found: {$csvFile}\n";
            return;
        }

        $csv = array_map('str_getcsv', file($csvFile));
        $header = array_shift($csv); // ヘッダー行を削除
        
        $authorsData = [];

        foreach ($csv as $row) {
            if (count($row) >= 3) { // 必要な列数があることを確認
                $authorsData[] = [
                    'name' => trim($row[0]),
                    'furigana' => trim($row[1]),
                    'bio' => trim($row[2]),
                    // period列はテーブルに存在しないため除外
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // データが存在する場合のみ挿入
        if (!empty($authorsData)) {
            // 一括挿入でパフォーマンスを向上
            $chunks = array_chunk($authorsData, 1000);
            foreach ($chunks as $chunk) {
                DB::table('m_authors')->insert($chunk);
            }
            
            echo "AuthorsSeeder: " . count($authorsData) . " records inserted successfully.\n";
        } else {
            echo "AuthorsSeeder: No valid data found in CSV file.\n";
        }
    }
}