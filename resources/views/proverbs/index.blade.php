{{-- ファイルパス: resources/views/proverbs/index.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語辞典')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">ことわざ・四字熟語辞典</h1>
            <p class="text-gray-600">日本の伝統的なことわざ、四字熟語、慣用句を意味と用例で学べます</p>
        </div>

        <!-- 種類別ナビゲーション -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">種類別で探す</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('proverbs.by-type', 'ことわざ') }}" 
                   class="bg-red-100 hover:bg-red-200 transition rounded-lg p-6 text-center shadow block">
                    <div class="text-2xl mb-2">📖</div>
                    <h3 class="text-xl font-bold text-red-800 mb-2">ことわざ</h3>
                    <p class="text-sm text-red-600">昔から伝わる教訓や知恵</p>
                </a>
                <a href="{{ route('proverbs.by-type', '四字熟語') }}" 
                   class="bg-green-100 hover:bg-green-200 transition rounded-lg p-6 text-center shadow block">
                    <div class="text-2xl mb-2">🀄</div>
                    <h3 class="text-xl font-bold text-green-800 mb-2">四字熟語</h3>
                    <p class="text-sm text-green-600">漢字四文字で表す慣用句</p>
                </a>
                <a href="{{ route('proverbs.by-type', '慣用句') }}" 
                   class="bg-purple-100 hover:bg-purple-200 transition rounded-lg p-6 text-center shadow block">
                    <div class="text-2xl mb-2">💭</div>
                    <h3 class="text-xl font-bold text-purple-800 mb-2">慣用句</h3>
                    <p class="text-sm text-purple-600">習慣的に使われる表現</p>
                </a>
            </div>
        </section>

        <!-- カテゴリ一覧 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">カテゴリで探す</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('proverb-categories.show', $category->id) }}" 
                       class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow block">
                        <span class="text-sm font-bold text-blue-800">{{ $category->name }}</span>
                        <div class="text-xs text-blue-600 mt-1">{{ $category->proverbs_count }}件</div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 人気のことわざ・四字熟語 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気のことわざ・四字熟語</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularProverbs as $proverb)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">{{ $proverb->type }}</span>
                            <a href="{{ route('proverbs.show', $proverb->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('proverbs.popular') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    人気ランキングをもっと見る
                </a>
            </div>
        </section>

        <!-- 最近見たことわざ・四字熟語 -->
        @if($recentProverbs->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">最近見たことわざ・四字熟語</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentProverbs as $proverb)
                        <div class="bg-gray-50 shadow rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                            <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                            <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs bg-gray-300 text-gray-700 px-2 py-1 rounded">{{ $proverb->type }}</span>
                                <a href="{{ route('proverbs.show', $proverb->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 検索ボックス -->
        <section class="mb-8 bg-gray-100 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">ことわざ・四字熟語を検索</h2>
            <form action="{{ route('proverbs.search') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <input type="text" name="q" placeholder="ことわざ、四字熟語、慣用句を検索..."
                       class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="type" class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">すべて</option>
                    <option value="ことわざ">ことわざ</option>
                    <option value="四字熟語">四字熟語</option>
                    <option value="慣用句">慣用句</option>
                </select>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    検索
                </button>
            </form>
        </section>
    </div>
@endsection