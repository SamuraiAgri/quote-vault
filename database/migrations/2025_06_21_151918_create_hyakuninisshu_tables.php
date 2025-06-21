<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHyakuninisshuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 歌人テーブル
        Schema::create('poets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('歌人名');
            $table->string('reading')->nullable()->comment('読み');
            $table->text('biography')->nullable()->comment('経歴・説明');
            $table->string('period')->nullable()->comment('時代');
            $table->timestamps();
        });

        // 百人一首テーブル
        Schema::create('hyakuninisshu', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique()->comment('番号（1-100）');
            $table->text('upper_phrase')->comment('上の句');
            $table->text('lower_phrase')->comment('下の句');
            $table->text('reading')->comment('読み');
            $table->text('modern_translation')->comment('現代語訳');
            $table->text('interpretation')->nullable()->comment('解釈・解説');
            $table->string('season')->nullable()->comment('季節');
            $table->string('theme')->nullable()->comment('テーマ（恋・自然・人生など）');
            $table->foreignId('poet_id')->constrained('poets')->onDelete('cascade');
            $table->integer('access_count')->default(0)->comment('アクセス数');
            $table->timestamp('last_accessed_at')->nullable()->comment('最終アクセス日時');
            $table->timestamps();
            
            // 検索用インデックス
            $table->fullText(['upper_phrase', 'lower_phrase', 'reading', 'modern_translation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hyakuninisshu');
        Schema::dropIfExists('poets');
    }
}