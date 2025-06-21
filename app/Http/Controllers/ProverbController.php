<?php
// app/Http/Controllers/ProverbController.php

namespace App\Http\Controllers;

use App\Models\Proverb;
use App\Models\ProverbCategory;
use Illuminate\Http\Request;

class ProverbController extends Controller
{
    public function index()
    {
        $categories = ProverbCategory::withCount('proverbs')->get();
        $popularProverbs = Proverb::popular()->limit(6)->get();
        $recentProverbs = Proverb::recentlyAccessed()->limit(6)->get();
        
        return view('proverbs.index', compact('categories', 'popularProverbs', 'recentProverbs'));
    }

    public function show($id)
    {
        $proverb = Proverb::with('category')->findOrFail($id);
        
        // アクセス数を増やす
        $proverb->incrementAccessCount();
        
        // 同じカテゴリの関連ことわざ
        $relatedProverbs = Proverb::where('category_id', $proverb->category_id)
                                 ->where('id', '!=', $proverb->id)
                                 ->limit(4)
                                 ->get();
        
        return view('proverbs.show', compact('proverb', 'relatedProverbs'));
    }

    public function byType($type)
    {
        $proverbs = Proverb::byType($type)->paginate(20);
        $typeName = [
            'ことわざ' => 'ことわざ',
            '四字熟語' => '四字熟語',
            '慣用句' => '慣用句'
        ][$type] ?? $type;
        
        return view('proverbs.by-type', compact('proverbs', 'type', 'typeName'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');
        $type = $request->get('type');
        
        if (empty($keyword)) {
            return view('proverbs.search', [
                'results' => null,
                'keyword' => null,
                'type' => $type
            ]);
        }
        
        $query = Proverb::search($keyword);
        
        if ($type) {
            $query->where('type', $type);
        }
        
        $results = $query->paginate(20);
        
        return view('proverbs.search', compact('results', 'keyword', 'type'));
    }

    public function popular()
    {
        $popularProverbs = Proverb::popular()->paginate(20);
        
        return view('proverbs.popular', compact('popularProverbs'));
    }
}