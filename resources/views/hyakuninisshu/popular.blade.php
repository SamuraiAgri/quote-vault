{{-- resources/views/hyakuninisshu/popular.blade.php --}}
@extends('layout')

@section('title', '人気の百人一首ランキング')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-blue-600">百人一首</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">人気ランキング</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-blue-800">人気の百人一首ランキング</h1>
            <p class="text-gray-600">アクセス数に基づく人気の和歌をご紹介します</p>
        </div>

        <!-- ランキング一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            @foreach($popularPoems as $index => $poem)
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition border-l-4 border-blue-500">
                    <!-- ランキング順位とメタ情報 -->
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
                        <div class="text-right">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm font-semibold">
                                {{ $poem->number }}番
                            </span>
                        </div>
                    </div>

                    <!-- 歌詞とメタ情報 -->
                    <div class="mb-4">
                        <div class="text-lg font-medium text-gray-800 leading-relaxed mb-3 font-serif bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded">
                            {{ $poem->upper_phrase }}<br>
                            {{ $poem->lower_phrase }}
                        </div>
                        <p class="text-sm text-blue-600 mb-2">
                            <a href="{{ route('poets.show', $poem->poet->id) }}" class="hover:text-blue-800">
                                {{ $poem->poet->name }}
                            </a>
                        </p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($poem->season)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                    🌸 {{ $poem->season }}
                                </span>
                            @endif
                            @if($poem->theme)
                                <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded text-xs">
                                    💝 {{ $poem->theme }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- 現代語訳 -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-700">{{ Str::limit($poem->modern_translation, 100) }}</p>
                    </div>

                    <!-- アクセス数と詳細リンク -->
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-sm text-gray-500">{{ $poem->access_count }}回閲覧</span>
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm font-semibold">
                            詳細を見る
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mb-8">
            {{ $popularPoems->links() }}
        </div>

        <!-- ナビゲーションボタン -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('hyakuninisshu.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 百人一首一覧に戻る
            </a>
            <a href="{{ route('hyakuninisshu.search') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                和歌を検索
            </a>
        </div>

        <!-- 季節・テーマ別人気ランキング -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center">季節・テーマ別人気ランキング</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 春の歌 -->
                <div class="bg-pink-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-pink-800 mb-4 text-center">🌸 春の人気歌</h3>
                    <div class="space-y-3">
                        @php
                            try {
                                $popularSpring = class_exists('App\Models\Hyakuninisshu') ? 
                                    App\Models\Hyakuninisshu::where('season', '春')->popular()->limit(3)->get() : 
                                    collect();
                            } catch (\Exception $e) {
                                $popularSpring = collect();
                            }
                        @endphp
                        @forelse($popularSpring as $index => $poem)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs bg-pink-200 text-pink-800 px-2 py-1 rounded">{{ $poem->number }}番</span>
                                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                       class="text-pink-600 hover:text-pink-800 text-xs">詳細</a>
                                </div>
                                <p class="text-sm font-medium text-gray-800">{{ Str::limit($poem->upper_phrase, 30) }}</p>
                                <p class="text-xs text-gray-600">- {{ $poem->poet->name }}</p>
                            </div>
                        @empty
                            <div class="bg-white rounded p-3 shadow-sm text-center">
                                <p class="text-sm text-gray-500">春の歌を準備中です</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('hyakuninisshu.by-season', '春') }}" 
                           class="text-pink-600 hover:text-pink-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>

                <!-- 夏の歌 -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-green-800 mb-4 text-center">🌻 夏の人気歌</h3>
                    <div class="space-y-3">
                        @php
                            try {
                                $popularSummer = class_exists('App\Models\Hyakuninisshu') ? 
                                    App\Models\Hyakuninisshu::where('season', '夏')->popular()->limit(3)->get() : 
                                    collect();
                            } catch (\Exception $e) {
                                $popularSummer = collect();
                            }
                        @endphp
                        @forelse($popularSummer as $index => $poem)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded">{{ $poem->number }}番</span>
                                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                       class="text-green-600 hover:text-green-800 text-xs">詳細</a>
                                </div>
                                <p class="text-sm font-medium text-gray-800">{{ Str::limit($poem->upper_phrase, 30) }}</p>
                                <p class="text-xs text-gray-600">- {{ $poem->poet->name }}</p>
                            </div>
                        @empty
                            <div class="bg-white rounded p-3 shadow-sm text-center">
                                <p class="text-sm text-gray-500">夏の歌を準備中です</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('hyakuninisshu.by-season', '夏') }}" 
                           class="text-green-600 hover:text-green-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>

                <!-- 秋の歌 -->
                <div class="bg-orange-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-orange-800 mb-4 text-center">🍁 秋の人気歌</h3>
                    <div class="space-y-3">
                        @php
                            try {
                                $popularAutumn = class_exists('App\Models\Hyakuninisshu') ? 
                                    App\Models\Hyakuninisshu::where('season', '秋')->popular()->limit(3)->get() : 
                                    collect();
                            } catch (\Exception $e) {
                                $popularAutumn = collect();
                            }
                        @endphp
                        @forelse($popularAutumn as $index => $poem)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs bg-orange-200 text-orange-800 px-2 py-1 rounded">{{ $poem->number }}番</span>
                                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                       class="text-orange-600 hover:text-orange-800 text-xs">詳細</a>
                                </div>
                                <p class="text-sm font-medium text-gray-800">{{ Str::limit($poem->upper_phrase, 30) }}</p>
                                <p class="text-xs text-gray-600">- {{ $poem->poet->name }}</p>
                            </div>
                        @empty
                            <div class="bg-white rounded p-3 shadow-sm text-center">
                                <p class="text-sm text-gray-500">秋の歌を準備中です</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('hyakuninisshu.by-season', '秋') }}" 
                           class="text-orange-600 hover:text-orange-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>

                <!-- 恋の歌 -->
                <div class="bg-purple-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-purple-800 mb-4 text-center">💕 恋の人気歌</h3>
                    <div class="space-y-3">
                        @php
                            try {
                                $popularLove = class_exists('App\Models\Hyakuninisshu') ? 
                                    App\Models\Hyakuninisshu::where('theme', '恋')->popular()->limit(3)->get() : 
                                    collect();
                            } catch (\Exception $e) {
                                $popularLove = collect();
                            }
                        @endphp
                        @forelse($popularLove as $index => $poem)
                            <div class="bg-white rounded p-3 shadow-sm">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs bg-purple-200 text-purple-800 px-2 py-1 rounded">{{ $poem->number }}番</span>
                                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                       class="text-purple-600 hover:text-purple-800 text-xs">詳細</a>
                                </div>
                                <p class="text-sm font-medium text-gray-800">{{ Str::limit($poem->upper_phrase, 30) }}</p>
                                <p class="text-xs text-gray-600">- {{ $poem->poet->name }}</p>
                            </div>
                        @empty
                            <div class="bg-white rounded p-3 shadow-sm text-center">
                                <p class="text-sm text-gray-500">恋の歌を準備中です</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('hyakuninisshu.by-theme', '恋') }}" 
                           class="text-purple-600 hover:text-purple-800 font-semibold text-sm">もっと見る →</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection