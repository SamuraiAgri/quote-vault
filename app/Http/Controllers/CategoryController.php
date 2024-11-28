<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 特定カテゴリの名言一覧
    public function show($id)
    {
        $category = Category::with('quotes.author')->findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
