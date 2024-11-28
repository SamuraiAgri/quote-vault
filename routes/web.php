<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LargeCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthorController;

// トップページ
Route::get('/', [QuoteController::class, 'index'])->name('home');

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