<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProverbsAndIdiomsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ことわざ・四字熟語カテゴリテーブル
        Schema::create('m_proverb_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('カテゴリ名');
            $table->string('description')->nullable()->comment('カテゴリ説明');
            $table->timestamps();
        });

        // ことわざ・四字熟語テーブル
        Schema::create('t_proverbs', function (Blueprint $table) {
            $table->id();
            $table->string('word')->comment('語句');
            $table->string('reading')->comment('読み');
            $table->text('meaning')->comment('意味');
            $table->text('example')->nullable()->comment('用例');
            $table->string('type')->comment('種類（ことわざ・四字熟語・慣用句）');
            $table->foreignId('category_id')->nullable()->constrained('m_proverb_categories')->onDelete('set null');
            $table->integer('access_count')->default(0)->comment('アクセス数');
            $table->timestamp('last_accessed_at')->nullable()->comment('最終アクセス日時');
            $table->timestamps();
            
            // フルテキストインデックス（インデックス名を短縮）
            $table->fullText(['word', 'reading', 'meaning'], 'proverbs_search_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_proverbs');
        Schema::dropIfExists('m_proverb_categories');
    }
}