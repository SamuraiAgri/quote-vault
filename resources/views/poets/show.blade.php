{{-- ファイルパス: resources/views/poets/show.blade.php --}}
@extends('layout')

@section('title', $poet->name . ' - 歌人詳細')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-purple-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-purple-600">百人一首</a></li>
                <li>›</li>
                <li><a href="{{ route('poets.index') }}" class="hover:text-purple-600">歌人一覧</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $poet->name }}</li>
            </ol>
        </nav>

        <!-- 歌人情報 -->
        <div class="bg-gradient-to-r from-purple-100 to-pink-100 shadow-lg rounded-lg p-8 mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-purple-800 mb-4">{{ $poet->name }}</h1>
                @if($poet->reading)
                    <p class="text-xl text-gray-700 mb-4">{{ $poet->reading }}</p>
                @endif
                
                <div class="flex justify-center items-center space-x-4 mb-6">
                    @if($poet->period)
                        <span class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold">
                            {{ $poet->period }}
                        </span>
                    @endif
                    <span class="bg-purple-500 text-white px-4 py-2 rounded-full font-semibold">
                        {{ $poems->count() }}首収録
                    </span>
                </div>

                @if($poet->biography)
                    <div class="bg-white bg-opacity-70 rounded-lg p-6 max-w-4xl mx-auto">
                        <h2 class="text-lg font-semibold text-purple-800 mb-3">歌人について</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $poet->biography }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- 収録されている歌 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center">{{ $poet->name }}の歌</h2>
            
            @if($poems->count() > 0)
                <div class="space-y-6">
                    @foreach($poems as $poem)
                        <div class="bg-white shadow-lg rounded-lg p-8 border-l-4 border-purple-500">
                            <!-- 歌番号と詳細情報 -->
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-lg font-bold">
                                    第{{ $poem->number }}首
                                </span>
                                <div class="flex space-x-2">
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
                            </div>

                            <!-- 和歌本文 -->
                            <div class="mb-6 text-center bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-lg">
                                <div class="text-2xl md:text-3xl font-medium text-gray-800 leading-relaxed mb-3 font-serif">
                                    {{ $poem->upper_phrase }}<br>
                                    {{ $poem->lower_phrase }}
                                </div>
                                <div class="text-lg text-gray-600">
                                    {{ $poem->reading }}
                                </div>
                            </div>

                            <!-- 現代語訳 -->
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 border-l-4 border-purple-400 pl-3">現代語訳</h3>
                                <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded">
                                    {{ $poem->modern_translation }}
                                </p>
                            </div>

                            <!-- 解釈・解説 -->
                            @if($poem->interpretation)
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2 border-l-4 border-green-400 pl-3">解釈・解説</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $poem->interpretation }}</p>
                                </div>
                            @endif

                            <!-- アクション -->
                            <div class="flex justify-between items-center pt-4 border-t">
                                <span class="text-sm text-gray-500">{{ $poem->access_count }}回閲覧</span>
                                <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                   class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                                    詳細ページで見る
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <p class="text-gray-600">この歌人の歌は現在登録されていません。</p>
                </div>
            @endif
        </section>

        <!-- ナビゲーション -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('poets.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 歌人一覧に戻る
            </a>
            <a href="{{ route('hyakuninisshu.index') }}" 
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                百人一首トップに戻る
            </a>
            @if($poet->period)
                <a href="{{ route('hyakuninisshu.search', ['poet_id' => $poet->id]) }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    この歌人で検索
                </a>
            @endif
        </div>

        <!-- 同時代の歌人 -->
        @if($poet->period)
            @php
                $contemporaryPoets = App\Models\Poet::where('period', $poet->period)
                                                   ->where('id', '!=', $poet->id)
                                                   ->withCount('hyakuninisshu')
                                                   ->limit(6)
                                                   ->get();
            @endphp
            @if($contemporaryPoets->count() > 0)
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">同時代（{{ $poet->period }}）の歌人</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach($contemporaryPoets as $contemporaryPoet)
                            <a href="{{ route('poets.show', $contemporaryPoet->id) }}" 
                               class="bg-white hover:bg-blue-50 shadow rounded-lg p-4 text-center transition">
                                <div class="font-bold text-blue-800 text-sm mb-1">{{ $contemporaryPoet->name }}</div>
                                <div class="text-xs text-gray-600">{{ $contemporaryPoet->hyakuninisshu_count }}首</div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif
    </div>
@endsection