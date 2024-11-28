<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesForQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 大カテゴリテーブル
        Schema::create('m_largecategories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('大カテゴリ名');
            $table->timestamps();
        });

        // カテゴリテーブル
        Schema::create('m_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('largecategory_id')->constrained('m_largecategories')->onDelete('cascade');
            $table->string('name')->comment('カテゴリ名');
            $table->timestamps();
        });

        // 著者テーブル
        Schema::create('m_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('著者名');
            $table->string('furigana')->nullable()->comment('著者名のフリガナ');
            $table->text('bio')->nullable()->comment('著者の説明');
            $table->timestamps();
        });

        // 名言テーブル
        Schema::create('t_quotes', function (Blueprint $table) {
            $table->id();
            $table->text('quote_text')->comment('名言本文');
            $table->string('quote_furigana')->nullable()->comment('名言のフリガナ');
            $table->foreignId('author_id')->constrained('m_authors')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('m_categories')->onDelete('cascade');
            $table->timestamp('last_accessed_at')->nullable()->comment('最終アクセス日時');
            $table->integer('popular_score')->default(0)->comment('人気スコア');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_quotes');
        Schema::dropIfExists('m_authors');
        Schema::dropIfExists('m_categories');
        Schema::dropIfExists('m_largecategories');
    }
}
