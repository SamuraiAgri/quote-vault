{{-- resources/views/proverbs/popular.blade.php --}}
@extends('layout')

@section('title', '人気のことわざ・四字熟語ランキング')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.index') }}" class="hover:text-blue-600">ことわざ・四字熟語辞典</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">人気ランキング</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-blue-800">人気のことわざ・四字熟語ランキング</h1>
            <p class="text-gray-600">アクセス数に基づく人気のことわざ・四字熟語をご紹介します</p>
        </div>

        <!-- ランキング一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($popularProverbs as $index => $proverb)
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                    <!-- ランキング順位 -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="text-2xl font-bold text-blue-600 mr-3">{{ $index + 1 }}位</div>
                            @if($index < 3)
                                <span class="text-2xl">
                                    @if($index === 0) 🥇
                                    @elseif($index === 1) 🥈
                                    @else 🥉
                                    @endif
                                </span>
                            @endif
                        </div>
                        <span class="bg-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-100 
                                    text-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-800 
                                    px-2 py-1 rounded text-xs font-semibold">
                            {{ $proverb->type }}
                        </span>
                    </div>

                    <!-- ことわざ・四字熟語 -->
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                    <p class="text-sm text-gray-600 mb-3">読み: {{ $proverb->reading }}</p>
                    <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 120) }}</p>

                    <!-- カテゴリ -->
                    @if($proverb->category)
                        <p class="text-xs text-gray-500 mb-3">
                            カテゴリ: 
                            <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" 
                               class="text-blue-600 hover:text-blue-800">{{ $proverb->category->name }}</a>
                        </p>
                    @endif

                    <!-- アクセス数と詳細リンク -->
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-sm text-gray-500">{{ $proverb->access_count }}回閲覧</span>
                        <a href="{{ route('proverbs.show', $proverb->id) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm font-semibold">
                            詳細を見る
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mb-8">
            {{ $popularProverbs->links() }}
        </div>

        <!-- ナビゲーションボタン -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('proverbs.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← ことわざ・四字熟語辞典トップに戻る
            </a>
            <a href="{{ route('proverbs.search') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                ことわざ・四字熟語を検索
            </a>
        </div>

        <!-- 種類別人気ランキング -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center">種類別人気ランキング</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- ことわざ -->
                <div class="bg-red-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-red-800 mb-4 text-center">📖 人気のことわざ</h3>
                    <div class="space-y-3">
                        @php
                            $popularKotowaza = App\Models\Proverb::where('type', 'ことわざ')->popular()->limit(5)->get();
                        @endphp
                        @foreach($popularKotowaza as $index => $proverb)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-red-800">{{ $index + 1 }}. {{ $proverb->word }}</span>
                                    <a href="{{ route('proverbs.show', $proverb->id) }}" 
                                       class="text-red-600 hover:text-red-800 text-xs">詳細</a>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($proverb->meaning, 50) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('proverbs.by-type', 'ことわざ') }}" 
                           class="text-red-600 hover:text-red-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>

                <!-- 四字熟語 -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-green-800 mb-4 text-center">🀄 人気の四字熟語</h3>
                    <div class="space-y-3">
                        @php
                            $popularYojijukugo = App\Models\Proverb::where('type', '四字熟語')->popular()->limit(5)->get();
                        @endphp
                        @foreach($popularYojijukugo as $index => $proverb)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-green-800">{{ $index + 1 }}. {{ $proverb->word }}</span>
                                    <a href="{{ route('proverbs.show', $proverb->id) }}" 
                                       class="text-green-600 hover:text-green-800 text-xs">詳細</a>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($proverb->meaning, 50) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('proverbs.by-type', '四字熟語') }}" 
                           class="text-green-600 hover:text-green-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>

                <!-- 慣用句 -->
                <div class="bg-purple-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-purple-800 mb-4 text-center">💭 人気の慣用句</h3>
                    <div class="space-y-3">
                        @php
                            $popularKanyouku = App\Models\Proverb::where('type', '慣用句')->popular()->limit(5)->get();
                        @endphp
                        @foreach($popularKanyouku as $index => $proverb)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-purple-800">{{ $index + 1 }}. {{ $proverb->word }}</span>
                                    <a href="{{ route('proverbs.show', $proverb->id) }}" 
                                       class="text-purple-600 hover:text-purple-800 text-xs">詳細</a>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($proverb->meaning, 50) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('proverbs.by-type', '慣用句') }}" 
                           class="text-purple-600 hover:text-purple-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection