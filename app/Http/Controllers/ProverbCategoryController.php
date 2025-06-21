<?php
// ファイルパス: app/Http/Controllers/ProverbController.php と app/Http/Controllers/ProverbCategoryController.php

namespace App\Http\Controllers;

use App\Models\Proverb;
use App\Models\ProverbCategory;
use Illuminate\Http\Request;

class ProverbCategoryController extends Controller
{
    public function index()
    {
        $categories = ProverbCategory::withCount('proverbs')->get();
        
        return view('proverb-categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = ProverbCategory::with('proverbs')->findOrFail($id);
        $proverbs = $category->proverbs()->paginate(20);
        
        return view('proverb-categories.show', compact('category', 'proverbs'));
    }
}