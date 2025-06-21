<?php
// app/Http/Controllers/HyakuninisshuController.php

namespace App\Http\Controllers;

use App\Models\Hyakuninisshu;
use App\Models\Poet;
use Illuminate\Http\Request;

class HyakuninisshuController extends Controller
{
    public function index()
    {
        $poems = Hyakuninisshu::with('poet')->byNumber()->paginate(20);
        $popularPoems = Hyakuninisshu::popular()->limit(6)->get();
        $seasons = ['春', '夏', '秋', '冬'];
        $themes = ['恋', '自然', '人生', '別れ', '思慕'];
        
        return view('hyakuninisshu.index', compact('poems', 'popularPoems', 'seasons', 'themes'));
    }

    public function show($id)
    {
        $poem = Hyakuninisshu::with('poet')->findOrFail($id);
        
        // アクセス数を増やす
        $poem->incrementAccessCount();
        
        // 同じ歌人の他の歌
        $poetPoems = Hyakuninisshu::where('poet_id', $poem->poet_id)
                                  ->where('id', '!=', $poem->id)
                                  ->limit(3)
                                  ->get();
        
        // 前後の歌
        $prevPoem = Hyakuninisshu::where('number', $poem->number - 1)->first();
        $nextPoem = Hyakuninisshu::where('number', $poem->number + 1)->first();
        
        return view('hyakuninisshu.show', compact('poem', 'poetPoems', 'prevPoem', 'nextPoem'));
    }

    public function bySeason($season)
    {
        $poems = Hyakuninisshu::bySeason($season)->with('poet')->paginate(20);
        
        return view('hyakuninisshu.by-season', compact('poems', 'season'));
    }

    public function byTheme($theme)
    {
        $poems = Hyakuninisshu::byTheme($theme)->with('poet')->paginate(20);
        
        return view('hyakuninisshu.by-theme', compact('poems', 'theme'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');
        $season = $request->get('season');
        $theme = $request->get('theme');
        $poet_id = $request->get('poet_id');
        
        if (empty($keyword) && empty($season) && empty($theme) && empty($poet_id)) {
            $poets = Poet::orderBy('name')->get();
            return view('hyakuninisshu.search', [
                'results' => null,
                'keyword' => null,
                'poets' => $poets,
                'selectedSeason' => $season,
                'selectedTheme' => $theme,
                'selectedPoetId' => $poet_id
            ]);
        }
        
        $query = Hyakuninisshu::with('poet');
        
        if ($keyword) {
            $query->search($keyword);
        }
        
        if ($season) {
            $query->bySeason($season);
        }
        
        if ($theme) {
            $query->byTheme($theme);
        }
        
        if ($poet_id) {
            $query->byPoet($poet_id);
        }
        
        $results = $query->paginate(20);
        $poets = Poet::orderBy('name')->get();
        
        return view('hyakuninisshu.search', compact('results', 'keyword', 'poets', 'season', 'theme', 'poet_id'));
    }

    public function popular()
    {
        $popularPoems = Hyakuninisshu::popular()->with('poet')->paginate(20);
        
        return view('hyakuninisshu.popular', compact('popularPoems'));
    }
}