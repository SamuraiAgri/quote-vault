{{-- resources/views/hyakuninisshu/index.blade.php --}}
@extends('layout')

@section('title', '百人一首・和歌解説')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-blue-800">百人一首・和歌解説</h1>
            <p class="text-gray-600">古典和歌の傑作100首を現代語訳・作者・季節とともに学べます</p>
        </div>

        <!-- 検索・フィルター -->
        <section class="mb-12 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-8">
            <h2 class="text-xl font-semibold mb-6 text-center text-blue-800">和歌を探す</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 季節で探す -->
                <div>
                    <h3 class="font-semibold mb-3 text-blue-800">季節で探す</h3>
                    <div class="space-y-2">
                        @foreach($seasons as $season)
                            <a href="{{ route('hyakuninisshu.by-season', $season) }}" 
                               class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg text-sm transition shadow hover:shadow-md">
                                <span class="mr-2">
                                    @if($season === '春') 🌸
                                    @elseif($season === '夏') 🌻  
                                    @elseif($season === '秋') 🍁
                                    @else ❄️
                                    @endif
                                </span>
                                {{ $season }}の歌
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- テーマで探す -->
                <div>
                    <h3 class="font-semibold mb-3 text-blue-800">テーマで探す</h3>
                    <div class="space-y-2">
                        @foreach($themes as $theme)
                            <a href="{{ route('hyakuninisshu.by-theme', $theme) }}" 
                               class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg text-sm transition shadow hover:shadow-md">
                                <span class="mr-2">
                                    @if($theme === '恋') 💕
                                    @elseif($theme === '自然') 🌿
                                    @elseif($theme === '人生') 🌟
                                    @elseif($theme === '別れ') 😢
                                    @else 💭
                                    @endif
                                </span>
                                {{ $theme }}の歌
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- 歌人で探す -->
                <div>
                    <h3 class="font-semibold mb-3 text-blue-800">歌人で探す</h3>
                    <a href="{{ route('poets.index') }}" 
                       class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg text-sm transition mb-3 shadow hover:shadow-md">
                        👤 歌人一覧を見る
                    </a>
                    <a href="{{ route('hyakuninisshu.popular') }}" 
                       class="block bg-white hover:bg-blue-50 px-4 py-3 rounded-lg text-sm transition shadow hover:shadow-md">
                        🏆 人気の歌ランキング
                    </a>
                </div>

                <!-- 検索 -->
                <div>
                    <h3 class="font-semibold mb-3 text-blue-800">キーワード検索</h3>
                    <form action="{{ route('hyakuninisshu.search') }}" method="GET">
                        <input type="text" name="q" placeholder="歌の内容を検索..."
                               class="w-full border border-gray-300 rounded-lg p-3 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition font-semibold">
                            検索
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- 人気の歌 -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-blue-800">人気の歌</h2>
                <a href="{{ route('hyakuninisshu.popular') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">もっと見る →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularPoems as $index => $poem)
                    <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-blue-600">{{ $index + 1 }}位</span>
                            <div class="flex space-x-2">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-semibold">
                                    {{ $poem->number }}番
                                </span>
                                @if($poem->season)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                        {{ $poem->season }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-lg font-medium text-gray-800 leading-relaxed mb-2 font-serif bg-gradient-to-r from-blue-50 to-purple-50 p-3 rounded">
                                {{ $poem->upper_phrase }}<br>
                                {{ $poem->lower_phrase }}
                            </p>
                            <p class="text-sm text-gray-600">
                                - <a href="{{ route('poets.show', $poem->poet->id) }}" 
                                     class="text-blue-600 hover:text-blue-800">{{ $poem->poet->name }}</a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ Str::limit($poem->modern_translation, 80) }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $poem->access_count }}回閲覧</span>
                            <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 百人一首リスト（番号順） -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-blue-800">百人一首一覧（番号順）</h2>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="grid grid-cols-5 sm:grid-cols-10 md:grid-cols-10 lg:grid-cols-20 gap-2">
                    @foreach($poems as $poem)
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                           class="bg-blue-50 hover:bg-blue-100 text-center py-4 px-2 rounded-lg transition border hover:border-blue-300 hover:shadow-md">
                            <div class="font-bold text-blue-600 text-lg">{{ $poem->number }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ Str::limit($poem->poet->name, 8) }}</div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $poems->links() }}
                </div>
            </div>
        </section>

        <!-- 季節・テーマ別ハイライト -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">季節・テーマ別ハイライト</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 春 -->
                <div class="bg-gradient-to-br from-pink-100 to-pink-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🌸</div>
                    <h3 class="font-bold text-pink-800 mb-2">春の歌</h3>
                    <p class="text-sm text-pink-700 mb-4">桜や新緑の美しさを詠んだ歌</p>
                    <a href="{{ route('hyakuninisshu.by-season', '春') }}" 
                       class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition text-sm">
                        詳細を見る
                    </a>
                </div>

                <!-- 恋 -->
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">💕</div>
                    <h3 class="font-bold text-purple-800 mb-2">恋の歌</h3>
                    <p class="text-sm text-purple-700 mb-4">恋心や切ない想いを詠んだ歌</p>
                    <a href="{{ route('hyakuninisshu.by-theme', '恋') }}" 
                       class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                        詳細を見る
                    </a>
                </div>

                <!-- 秋 -->
                <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🍁</div>
                    <h3 class="font-bold text-orange-800 mb-2">秋の歌</h3>
                    <p class="text-sm text-orange-700 mb-4">紅葉や月の美しさを詠んだ歌</p>
                    <a href="{{ route('hyakuninisshu.by-season', '秋') }}" 
                       class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition text-sm">
                        詳細を見る
                    </a>
                </div>

                <!-- 人生 -->
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🌟</div>
                    <h3 class="font-bold text-blue-800 mb-2">人生の歌</h3>
                    <p class="text-sm text-blue-700 mb-4">人生の無常や深い思索を詠んだ歌</p>
                    <a href="{{ route('hyakuninisshu.by-theme', '人生') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                        詳細を見る
                    </a>
                </div>
            </div>
        </section>

        <!-- 学習ガイド -->
        <section class="mb-8 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">百人一首学習ガイド</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="font-bold text-blue-700 mb-3 flex items-center">
                        <span class="mr-2">📚</span>学習のポイント
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• 上の句と下の句の関係を理解する</li>
                        <li>• 現代語訳で意味を把握する</li>
                        <li>• 歌人の背景や時代を知る</li>
                        <li>• 季節や情景を想像しながら読む</li>
                    </ul>
                </div>
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="font-bold text-green-700 mb-3 flex items-center">
                        <span class="mr-2">🎯</span>楽しみ方
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• 好きな季節やテーマから始める</li>
                        <li>• 音読して美しい響きを味わう</li>
                        <li>• 歌の情景を思い浮かべる</li>
                        <li>• 現代の自分の気持ちと重ね合わせる</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection