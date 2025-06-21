{{-- ファイルパス: resources/views/hyakuninisshu/show.blade.php --}}
@extends('layout')

@section('title', $poem->number . '番 - ' . $poem->poet->name . ' - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-purple-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-purple-600">百人一首</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $poem->number }}番 - {{ $poem->poet->name }}</li>
            </ol>
        </nav>

        <!-- 前後ナビゲーション -->
        <div class="flex justify-between items-center mb-6">
            @if($prevPoem)
                <a href="{{ route('hyakuninisshu.show', $prevPoem->id) }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition text-sm">
                    ← {{ $prevPoem->number }}番
                </a>
            @else
                <div></div>
            @endif
            
            <div class="text-center">
                <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-bold">
                    {{ $poem->number }}番 / 100首
                </span>
            </div>
            
            @if($nextPoem)
                <a href="{{ route('hyakuninisshu.show', $nextPoem->id) }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition text-sm">
                    {{ $nextPoem->number }}番 →
                </a>
            @else
                <div></div>
            @endif
        </div>

        <!-- メイン詳細 -->
        <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
            <!-- 歌人情報 -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-purple-800 mb-2">
                    <a href="{{ route('poets.show', $poem->poet->id) }}" class="hover:text-purple-600">
                        {{ $poem->poet->name }}
                    </a>
                </h1>
                <p class="text-gray-600">{{ $poem->poet->reading }}</p>
                @if($poem->poet->period)
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">{{ $poem->poet->period }}</span>
                @endif
            </div>

            <!-- 和歌本文 -->
            <div class="mb-8 text-center bg-gradient-to-r from-purple-50 to-pink-50 p-8 rounded-lg">
                <div class="text-2xl md:text-3xl font-medium text-gray-800 leading-relaxed mb-4 font-serif">
                    {{ $poem->upper_phrase }}<br>
                    {{ $poem->lower_phrase }}
                </div>
                <div class="text-lg text-gray-600 font-light">
                    {{ $poem->reading }}
                </div>
            </div>

            <!-- メタ情報 -->
            <div class="mb-6 flex flex-wrap justify-center gap-2">
                @if($poem->season)
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                        🌸 {{ $poem->season }}
                    </span>
                @endif
                @if($poem->theme)
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">
                        💝 {{ $poem->theme }}
                    </span>
                @endif
            </div>

            <!-- 現代語訳 -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-purple-500 pl-3">現代語訳</h2>
                <p class="text-gray-700 leading-relaxed text-lg bg-gray-50 p-4 rounded-lg">
                    {{ $poem->modern_translation }}
                </p>
            </div>

            <!-- 解釈・解説 -->
            @if($poem->interpretation)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-green-500 pl-3">解釈・解説</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $poem->interpretation }}</p>
                </div>
            @endif

            <!-- 歌人について -->
            @if($poem->poet->biography)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-blue-500 pl-3">歌人について</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $poem->poet->biography }}</p>
                </div>
            @endif

            <!-- アクセス情報 -->
            <div class="border-t pt-4 text-sm text-gray-500">
                <p>閲覧数: {{ $poem->access_count }}回</p>
                @if($poem->last_accessed_at)
                    <p>最終アクセス: {{ $poem->last_accessed_at->format('Y年m月d日 H:i') }}</p>
                @endif
            </div>
        </div>

        <!-- 同じ歌人の他の歌 -->
        @if($poetPoems->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">{{ $poem->poet->name }}の他の歌</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($poetPoems as $poetPoem)
                        <div class="bg-white shadow rounded-lg p-4">
                            <div class="mb-2">
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">
                                    {{ $poetPoem->number }}番
                                </span>
                            </div>
                            <p class="text-sm text-gray-800 mb-3 font-medium">
                                {{ $poetPoem->upper_phrase }}<br>
                                {{ $poetPoem->lower_phrase }}
                            </p>
                            <a href="{{ route('hyakuninisshu.show', $poetPoem->id) }}" 
                               class="text-purple-600 hover:text-purple-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ナビゲーションボタン -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <a href="{{ route('hyakuninisshu.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 百人一首一覧に戻る
            </a>
            <a href="{{ route('poets.show', $poem->poet->id) }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                {{ $poem->poet->name }}の歌一覧
            </a>
            @if($poem->season)
                <a href="{{ route('hyakuninisshu.by-season', $poem->season) }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                    {{ $poem->season }}の歌一覧
                </a>
            @endif
            @if($poem->theme)
                <a href="{{ route('hyakuninisshu.by-theme', $poem->theme) }}" 
                   class="bg-pink-600 text-white px-6 py-3 rounded-lg hover:bg-pink-700 transition">
                    {{ $poem->theme }}の歌一覧
                </a>
            @endif
        </div>
    </div>
@endsection