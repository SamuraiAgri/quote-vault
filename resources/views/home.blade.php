{{-- resources/views/home.blade.php --}}
@extends('layout')

@section('title', 'ホーム')

@section('content')
    <div class="relative">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">偉人の名言・格言・ことわざ・百人一首サイト</h1>
            <p class="text-gray-600">このサイトでは、偉人の名言や格言、ことわざ・四字熟語、百人一首をカテゴリ別、著者別、キーワード検索で探すことができます。</p>
        </div>
        <!-- メイン画像の中央配置、上を移動 -->
        <div class="relative">
            <img src="{{ asset('img/ijin.png') }}" alt="偉人のシルエット" class="w-full h-auto object-cover mx-auto" style="max-height: 600px; object-position: top;">
        </div>
    </div>

    <!-- コンテンツ種別ナビゲーション -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold py-8">コンテンツ</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('largecategories.index') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <h3 class="text-lg font-bold text-blue-800 mb-2">名言・格言</h3>
                <p class="text-sm text-gray-600">偉人の名言や格言を探す</p>
            </a>
            <a href="{{ route('proverbs.index') }}" class="bg-green-100 hover:bg-green-200 transition rounded-lg p-4 text-center shadow">
                <h3 class="text-lg font-bold text-green-800 mb-2">ことわざ・四字熟語</h3>
                <p class="text-sm text-gray-600">日本の伝統的な言葉を探す</p>
            </a>
            <a href="{{ route('hyakuninisshu.index') }}" class="bg-purple-100 hover:bg-purple-200 transition rounded-lg p-4 text-center shadow">
                <h3 class="text-lg font-bold text-purple-800 mb-2">百人一首</h3>
                <p class="text-sm text-gray-600">古典の和歌を探す</p>
            </a>
            <a href="{{ route('search.index') }}" class="bg-orange-100 hover:bg-orange-200 transition rounded-lg p-4 text-center shadow">
                <h3 class="text-lg font-bold text-orange-800 mb-2">検索</h3>
                <p class="text-sm text-gray-600">すべてのコンテンツから検索</p>
            </a>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold py-8">大カテゴリ一覧</h2>
        <!-- gridを使用して3カラムに変更 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($largeCategories as $largeCategory)
                <div class="bg-blue-100 rounded-lg shadow-lg p-4 text-center hover:bg-blue-200 transition-all">
                    <a href="{{ route('largecategories.show', $largeCategory->id) }}" class="text-blue-700 font-semibold">
                        {{ $largeCategory->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 人気の名言セクション -->
    <section class="mb-8 py-8">
        <h2 class="text-2xl font-semibold mb-4 mt-8">人気の名言</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($popularQuotes as $quote)
                <div class="bg-white shadow rounded p-6">
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                    <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 人気のことわざ・四字熟語セクション -->
    @if($popularProverbs->count() > 0)
    <section class="mb-8 py-8">
        <h2 class="text-2xl font-semibold mb-4">人気のことわざ・四字熟語</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($popularProverbs as $proverb)
                <div class="bg-white shadow rounded p-6">
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $proverb->reading }}</p>
                    <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 60) }}</p>
                    <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-green-600 border-2 border-green-600 hover:bg-green-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- 人気の百人一首セクション -->
    @if($popularPoems->count() > 0)
    <section class="mb-8 py-8">
        <h2 class="text-2xl font-semibold mb-4">人気の百人一首</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($popularPoems as $poem)
                <div class="bg-white shadow rounded p-6">
                    <div class="text-purple-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                    <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                    <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                    <p class="text-sm text-gray-600">歌人: {{ $poem->poet->name }}</p>
                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-purple-600 border-2 border-purple-600 hover:bg-purple-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- 直近でアクセスされた名言セクション -->
    <section class="mb-2 py-2">
        <h2 class="text-2xl font-semibold mb-4 mt-2">直近でアクセスされた名言</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentQuotes as $quote)
                <div class="bg-white shadow rounded p-6">
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                    <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection