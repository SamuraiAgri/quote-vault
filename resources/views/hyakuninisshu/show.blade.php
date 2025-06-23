{{-- resources/views/hyakuninisshu/show.blade.php --}}
@extends('layout')

@section('title', '第' . $poem->number . '番 - ' . $poem->poet->name)

@section('content')
    <div class="container mx-auto px-4">
        <!-- 歌の詳細 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <div class="text-3xl font-bold text-blue-800 mb-4">第{{ $poem->number }}番</div>
            <div class="text-2xl text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
            <div class="text-2xl text-gray-800 mb-6">{{ $poem->lower_phrase }}</div>
            <div class="text-lg text-gray-600 mb-4">{{ $poem->reading }}</div>
            <p class="text-lg text-gray-700 mb-4">歌人: 
                <a href="{{ route('poets.show', $poem->poet->id) }}" class="text-blue-500 underline">
                    {{ $poem->poet->name }}
                </a>
            </p>
        </div>

        <!-- 現代語訳と解釈 -->
        <div class="bg-gray-100 shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">現代語訳</h2>
            <p class="text-lg text-gray-800 mb-6">{{ $poem->modern_translation }}</p>
            
            @if($poem->interpretation)
                <h2 class="text-2xl font-semibold mb-4">解釈・解説</h2>
                <p class="text-lg text-gray-800">{{ $poem->interpretation }}</p>
            @endif
        </div>

        <!-- 詳細情報 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">詳細情報</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($poem->season)
                    <p class="text-lg text-gray-600">
                        季節: 
                        <a href="{{ route('hyakuninisshu.by-season', $poem->season) }}" class="text-blue-500 underline">
                            {{ $poem->season }}
                        </a>
                    </p>
                @endif
                @if($poem->theme)
                    <p class="text-lg text-gray-600">
                        テーマ: 
                        <a href="{{ route('hyakuninisshu.by-theme', $poem->theme) }}" class="text-blue-500 underline">
                            {{ $poem->theme }}
                        </a>
                    </p>
                @endif
                <p class="text-lg text-gray-600">アクセス数: {{ $poem->access_count }}</p>
                @if($poem->last_accessed_at)
                    <p class="text-lg text-gray-600">最終アクセス: {{ $poem->last_accessed_at->format('Y年m月d日') }}</p>
                @endif
            </div>
        </div>

        <!-- 前後の歌へのナビゲーション -->
        <div class="flex justify-between mb-8">
            @if($prevPoem)
                <a href="{{ route('hyakuninisshu.show', $prevPoem->id) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    ← 第{{ $prevPoem->number }}番
                </a>
            @else
                <div></div>
            @endif
            
            @if($nextPoem)
                <a href="{{ route('hyakuninisshu.show', $nextPoem->id) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    第{{ $nextPoem->number }}番 →
                </a>
            @else
                <div></div>
            @endif
        </div>

        <!-- 同じ歌人の他の歌 -->
        @if($poetPoems->count() > 0)
            <section>
                <h2 class="text-2xl font-semibold mb-4">{{ $poem->poet->name }}の他の歌</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($poetPoems as $poetPoem)
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poetPoem->number }}番</div>
                            <div class="text-lg text-gray-800 mb-2">{{ $poetPoem->upper_phrase }}</div>
                            <div class="text-lg text-gray-800 mb-4">{{ $poetPoem->lower_phrase }}</div>
                            <a href="{{ route('hyakuninisshu.show', $poetPoem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                                詳細を見る
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection