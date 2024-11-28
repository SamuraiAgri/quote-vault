<?php

namespace App\Http\Controllers;

use App\Models\LargeCategory;
use Illuminate\Http\Request;

class LargeCategoryController extends Controller
{
    // 大カテゴリ一覧
    public function index()
    {
        $largeCategories = LargeCategory::all();
        return view('largecategories.index', compact('largeCategories'));
    }

    // 特定の大カテゴリのカテゴリ一覧
    public function show($id)
    {
        $largeCategory = LargeCategory::with('categories')->findOrFail($id);
        return view('largecategories.show', compact('largeCategory'));
    }
}
