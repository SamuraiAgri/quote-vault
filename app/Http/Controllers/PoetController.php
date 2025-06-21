<?php
// ファイルパス: app/Http/Controllers/HyakuninisshuController.php と app/Http/Controllers/PoetController.php

namespace App\Http\Controllers;

use App\Models\Hyakuninisshu;
use App\Models\Poet;
use Illuminate\Http\Request;

class PoetController extends Controller
{
    public function index()
    {
        $poets = Poet::withCount('hyakuninisshu')->orderBy('name')->get();
        
        return view('poets.index', compact('poets'));
    }

    public function show($id)
    {
        $poet = Poet::with('hyakuninisshu')->findOrFail($id);
        $poems = $poet->hyakuninisshu()->byNumber()->get();
        
        return view('poets.show', compact('poet', 'poems'));
    }
}