{{-- ファイルパス: resources/views/hyakuninisshu/index.blade.php --}}
@extends('layout')

@section('title', '百人一首・和歌解説')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">百人一首・和歌解説</h1>
            <p class="text-gray-600">古典和歌の傑作100首を現代語訳・作者・季節とともに学べます</p>
        </div>

        <!-- 検索・フィルター -->
        <section class="mb-8 bg-gradient-to-r from-purple-100 to-pink-100 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">和歌を探す</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- 季節で探す -->
                <div>
                    <h3 class="font-semibold mb-2 text-purple-800">季節で探す</h3>
                    <div class="space-y-1">
                        @foreach($seasons as $season)
                            <a href="{{ route('hyakuninisshu.by-season', $season) }}" 
                               class="block bg-white hover:bg-purple-50 px-3 py-2 rounded text-sm transition">
                                🌸 {{ $season }}の歌
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- テーマで探す -->
                <div>
                    <h3 class="font-semibold mb-2 text-purple-800">テーマで探す</h3>
                    <div class="space-y-1">
                        @foreach($themes as $theme)
                            <a href="{{ route('hyakuninisshu.by-theme', $theme) }}" 
                               class="block bg-white hover:bg-purple-50 px-3 py-2 rounded text-sm transition">
                                💝 {{ $theme }}の歌
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- 歌人で探す -->
                <div>
                    <h3 class="font-semibold mb-2 text-purple-800">歌人で探す</h3>
                    <a href="{{ route('poets.index') }}" 
                       class="block bg-white hover:bg-purple-50 px-3 py-2 rounded text-sm transition mb-2">
                        👤 歌人一覧を見る
                    </a>
                    <a href="{{ route('hyakuninisshu.popular') }}" 
                       class="block bg-white hover:bg-purple-50 px-3 py-2 rounded text-sm transition">
                        🏆 人気の歌ランキング
                    </a>
                </div>

                <!-- 検索 -->
                <div>
                    <h3 class="font-semibold mb-2 text-purple-800">キーワード検索</h3>
                    <form action="{{ route('hyakuninisshu.search') }}" method="GET">
                        <input type="text" name="q" placeholder="歌の内容を検索..."
                               class="w-full border border-gray-300 rounded p-2 text-sm mb-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <button type="submit" 
                                class="w-full bg-purple-600 text-white py-2 rounded text-sm hover:bg-purple-700 transition">
                            検索
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- 人気の歌 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気の歌</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularPoems as $poem)
                    <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-purple-500">
                        <div class="mb-3">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm font-semibold">
                                {{ $poem->number }}番
                            </span>
                            @if($poem->season)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs ml-2">
                                    {{ $poem->season }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-lg font-medium text-gray-800 leading-relaxed mb-2">
                                {{ $poem->upper_phrase }}<br>
                                {{ $poem->lower_phrase }}
                            </p>
                            <p class="text-sm text-gray-600">
                                - <a href="{{ route('poets.show', $poem->poet->id) }}" 
                                     class="text-purple-600 hover:text-purple-800">{{ $poem->poet->name }}</a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ Str::limit($poem->modern_translation, 80) }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $poem->access_count }}回閲覧</span>
                            <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                               class="text-purple-600 hover:text-purple-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('hyakuninisshu.popular') }}" 
                   class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                    人気ランキングをもっと見る
                </a>
            </div>
        </section>

        <!-- 百人一首リスト（番号順） -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">百人一首一覧（番号順）</h2>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-10 gap-2">
                    @foreach($poems as $poem)
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                           class="bg-gray-100 hover:bg-purple-100 text-center py-3 rounded transition border hover:border-purple-300">
                            <div class="font-bold text-purple-600">{{ $poem->number }}</div>
                            <div class="text-xs text-gray-600">{{ $poem->poet->name }}</div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $poems->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection