<?php
// ファイルパス: database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // 既存の名言・格言関連シーダー
            LargeCategoriesSeeder::class,
            CategoriesSeeder::class,
            AuthorsSeeder::class,
            QuotesSeeder::class,
            
            // 新規追加：ことわざ・四字熟語関連シーダー
            ProverbCategoriesSeeder::class,
            ProverbsSeeder::class,
            
            // 新規追加：百人一首関連シーダー
            PoetsSeeder::class,
            HyakuninisshuSeeder::class,
        ]);
    }
}