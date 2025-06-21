<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LargeCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProverbController;
use App\Http\Controllers\ProverbCategoryController;
use App\Http\Controllers\HyakuninisshuController;
use App\Http\Controllers\PoetController;

// トップページ
Route::get('/', [QuoteController::class, 'index'])->name('home');

// === 名言・格言関連 ===
// 大カテゴリ一覧
Route::get('/largecategories', [LargeCategoryController::class, 'index'])->name('largecategories.index');

// 特定大カテゴリのカテゴリ一覧
Route::get('/largecategories/{id}', [LargeCategoryController::class, 'show'])->name('largecategories.show');

// 特定カテゴリの名言一覧
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// 名言詳細ページ
Route::get('/quotes/{id}', [QuoteController::class, 'show'])->name('quotes.show');

// 検索機能
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// 著者一覧ページ
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

// 特定著者の名言一覧
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

// 人気の名言ランキング
Route::get('/popular', [QuoteController::class, 'popular'])->name('quotes.popular');

// === ことわざ・四字熟語関連 ===
// ことわざ・四字熟語トップページ
Route::get('/proverbs', [ProverbController::class, 'index'])->name('proverbs.index');

// ことわざ・四字熟語詳細
Route::get('/proverbs/{id}', [ProverbController::class, 'show'])->name('proverbs.show');

// 種類別一覧（ことわざ、四字熟語、慣用句）
Route::get('/proverbs/type/{type}', [ProverbController::class, 'byType'])->name('proverbs.by-type');

// ことわざ・四字熟語検索
Route::get('/proverbs/search', [ProverbController::class, 'search'])->name('proverbs.search');

// 人気のことわざ・四字熟語
Route::get('/proverbs/popular', [ProverbController::class, 'popular'])->name('proverbs.popular');

// ことわざ・四字熟語カテゴリ一覧
Route::get('/proverb-categories', [ProverbCategoryController::class, 'index'])->name('proverb-categories.index');

// ことわざ・四字熟語カテゴリ詳細
Route::get('/proverb-categories/{id}', [ProverbCategoryController::class, 'show'])->name('proverb-categories.show');

// === 百人一首関連 ===
// 百人一首トップページ
Route::get('/hyakuninisshu', [HyakuninisshuController::class, 'index'])->name('hyakuninisshu.index');

// 百人一首詳細
Route::get('/hyakuninisshu/{id}', [HyakuninisshuController::class, 'show'])->name('hyakuninisshu.show');

// 季節別百人一首
Route::get('/hyakuninisshu/season/{season}', [HyakuninisshuController::class, 'bySeason'])->name('hyakuninisshu.by-season');

// テーマ別百人一首
Route::get('/hyakuninisshu/theme/{theme}', [HyakuninisshuController::class, 'byTheme'])->name('hyakuninisshu.by-theme');

// 百人一首検索
Route::get('/hyakuninisshu/search', [HyakuninisshuController::class, 'search'])->name('hyakuninisshu.search');

// 人気の百人一首
Route::get('/hyakuninisshu/popular', [HyakuninisshuController::class, 'popular'])->name('hyakuninisshu.popular');

// 歌人一覧
Route::get('/poets', [PoetController::class, 'index'])->name('poets.index');

// 歌人詳細
Route::get('/poets/{id}', [PoetController::class, 'show'])->name('poets.show');