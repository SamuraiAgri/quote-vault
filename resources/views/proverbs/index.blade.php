{{-- resources/views/proverbs/index.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語辞典')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-blue-800">ことわざ・四字熟語辞典</h1>
            <p class="text-gray-600">日本の伝統的なことわざ、四字熟語、慣用句を意味と用例で学べます</p>
        </div>

        <!-- 種類別ナビゲーション -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">種類別で探す</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('proverbs.by-type', 'ことわざ') }}" 
                   class="bg-white shadow-lg hover:shadow-xl transition-all duration-300 rounded-lg p-8 text-center transform hover:-translate-y-2 border-l-4 border-blue-500">
                    <div class="text-4xl mb-4">📖</div>
                    <h3 class="text-xl font-bold text-blue-800 mb-3">ことわざ</h3>
                    <p class="text-sm text-gray-600 mb-4">昔から伝わる教訓や知恵を含んだ短い言葉</p>
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm inline-block">
                        @php
                            try {
                                $kotowazaCount = class_exists('App\Models\Proverb') ? 
                                    App\Models\Proverb::where('type', 'ことわざ')->count() : 0;
                            } catch (\Exception $e) {
                                $kotowazaCount = 0;
                            }
                        @endphp
                        {{ $kotowazaCount }}件
                    </div>
                </a>
                <a href="{{ route('proverbs.by-type', '四字熟語') }}" 
                   class="bg-white shadow-lg hover:shadow-xl transition-all duration-300 rounded-lg p-8 text-center transform hover:-translate-y-2 border-l-4 border-blue-500">
                    <div class="text-4xl mb-4">🀄</div>
                    <h3 class="text-xl font-bold text-blue-800 mb-3">四字熟語</h3>
                    <p class="text-sm text-gray-600 mb-4">漢字四文字で表現される熟語や慣用句</p>
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm inline-block">
                        @php
                            try {
                                $yojijukugoCount = class_exists('App\Models\Proverb') ? 
                                    App\Models\Proverb::where('type', '四字熟語')->count() : 0;
                            } catch (\Exception $e) {
                                $yojijukugoCount = 0;
                            }
                        @endphp
                        {{ $yojijukugoCount }}件
                    </div>
                </a>
                <a href="{{ route('proverbs.by-type', '慣用句') }}" 
                   class="bg-white shadow-lg hover:shadow-xl transition-all duration-300 rounded-lg p-8 text-center transform hover:-translate-y-2 border-l-4 border-blue-500">
                    <div class="text-4xl mb-4">💭</div>
                    <h3 class="text-xl font-bold text-blue-800 mb-3">慣用句</h3>
                    <p class="text-sm text-gray-600 mb-4">習慣的に使われる決まった表現</p>
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm inline-block">
                        @php
                            try {
                                $kanyoukuCount = class_exists('App\Models\Proverb') ? 
                                    App\Models\Proverb::where('type', '慣用句')->count() : 0;
                            } catch (\Exception $e) {
                                $kanyoukuCount = 0;
                            }
                        @endphp
                        {{ $kanyoukuCount }}件
                    </div>
                </a>
            </div>
        </section>

        <!-- カテゴリ一覧 -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">カテゴリで探す</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('proverb-categories.show', $category->id) }}" 
                       class="bg-blue-100 hover:bg-blue-200 transition-all duration-300 rounded-lg p-4 text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <span class="text-sm font-bold text-blue-800 block mb-1">{{ $category->name }}</span>
                        <div class="text-xs text-blue-600">{{ $category->proverbs_count }}件</div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('proverb-categories.index') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    すべてのカテゴリを見る
                </a>
            </div>
        </section>

        <!-- 人気のことわざ・四字熟語 -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-blue-800">人気のことわざ・四字熟語</h2>
                <a href="{{ route('proverbs.popular') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">もっと見る →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularProverbs as $index => $proverb)
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition border-l-4 border-blue-500">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-blue-600">{{ $index + 1 }}位</span>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ $proverb->type }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $proverb->access_count }}回閲覧</span>
                            <a href="{{ route('proverbs.show', $proverb->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 最近見たことわざ・四字熟語 -->
        @if($recentProverbs->count() > 0)
            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-6 text-blue-800">最近見たことわざ・四字熟語</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentProverbs as $proverb)
                        <div class="bg-gray-50 shadow-lg rounded-lg p-6 hover:shadow-xl transition border-l-4 border-gray-400">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs bg-gray-300 text-gray-700 px-2 py-1 rounded">{{ $proverb->type }}</span>
                                <span class="text-xs text-gray-500">
                                    {{ $proverb->last_accessed_at ? $proverb->last_accessed_at->format('m/d') : '' }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                            <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                            <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 100) }}</p>
                            <a href="{{ route('proverbs.show', $proverb->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 検索ボックス -->
        <section class="mb-8 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-8 shadow-lg">
            <h2 class="text-xl font-semibold mb-6 text-center text-blue-800">ことわざ・四字熟語を検索</h2>
            <form action="{{ route('proverbs.search') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="q" placeholder="ことわざ、四字熟語、慣用句を検索..."
                           class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select name="type" class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">すべて</option>
                        <option value="ことわざ">ことわざ</option>
                        <option value="四字熟語">四字熟語</option>
                        <option value="慣用句">慣用句</option>
                    </select>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        検索
                    </button>
                </div>
            </form>
        </section>

        <!-- 学習のポイント -->
        <section class="mb-8 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">学習のポイント</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                    <h3 class="font-bold text-blue-700 mb-3 flex items-center">
                        <span class="mr-2">📚</span>効果的な学習法
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• 意味を理解してから覚える</li>
                        <li>• 用例を読んで使い方を学ぶ</li>
                        <li>• 類似の表現と比較して覚える</li>
                        <li>• 日常会話で実際に使ってみる</li>
                    </ul>
                </div>
                <div class="bg-green-50 rounded-lg p-6 border border-green-200">
                    <h3 class="font-bold text-green-700 mb-3 flex items-center">
                        <span class="mr-2">🎯</span>活用のコツ
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• 場面に適した表現を選ぶ</li>
                        <li>• 正しい読み方を身につける</li>
                        <li>• 文章作成時に効果的に使う</li>
                        <li>• カテゴリ別に系統立てて学ぶ</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection