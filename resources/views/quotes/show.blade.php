{{-- resources/views/quotes/show.blade.php --}}
@extends('layout')

@section('title', $quote->author->name . 'の名言 - 名言詳細')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('largecategories.index') }}" class="hover:text-blue-600">名言・格言</a></li>
                <li>›</li>
                <li><a href="{{ route('authors.show', $quote->author->id) }}" class="hover:text-blue-600">{{ $quote->author->name }}</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">名言詳細</li>
            </ol>
        </nav>

        <!-- メイン詳細 -->
        <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
            <!-- 著者情報 -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-blue-800 mb-2">
                    <a href="{{ route('authors.show', $quote->author->id) }}" class="hover:text-blue-600">
                        {{ $quote->author->name }}
                    </a>
                </h1>
                @if($quote->author->bio)
                    <p class="text-gray-600 text-sm">{{ Str::limit($quote->author->bio, 150) }}</p>
                @endif
            </div>

            <!-- 名言本文 -->
            <div class="mb-8 text-center bg-gradient-to-r from-blue-50 to-blue-100 p-8 rounded-lg">
                <blockquote class="text-2xl md:text-3xl font-medium text-gray-800 italic leading-relaxed">
                    "{{ $quote->quote_text }}"
                </blockquote>
                @if($quote->quote_furigana)
                    <div class="text-lg text-gray-600 mt-4">
                        {{ $quote->quote_furigana }}
                    </div>
                @endif
            </div>

            <!-- メタ情報 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- 著者情報 -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3 border-l-4 border-blue-500 pl-3">著者</h2>
                    <p class="text-gray-700">
                        <a href="{{ route('authors.show', $quote->author->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            {{ $quote->author->name }}
                        </a>
                    </p>
                    @if($quote->author->bio)
                        <p class="text-sm text-gray-600 mt-2">{{ Str::limit($quote->author->bio, 200) }}</p>
                    @endif
                </div>

                <!-- カテゴリ情報 -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3 border-l-4 border-green-500 pl-3">カテゴリ</h2>
                    <p class="text-gray-700 mb-2">
                        <a href="{{ route('categories.show', $quote->category->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            {{ $quote->category->name }}
                        </a>
                    </p>
                    @if($quote->category->largeCategory)
                        <p class="text-sm text-gray-600">
                            大カテゴリ: 
                            <a href="{{ route('largecategories.show', $quote->category->largeCategory->id) }}" 
                               class="text-blue-600 hover:text-blue-800">
                                {{ $quote->category->largeCategory->name }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <!-- アクセス情報 -->
            <div class="border-t pt-4 text-sm text-gray-500">
                <p>人気スコア: {{ $quote->popular_score }}点</p>
                @if($quote->last_accessed_at)
                    <p>最終アクセス: {{ $quote->last_accessed_at->format('Y年m月d日 H:i') }}</p>
                @endif
            </div>
        </div>

        <!-- 関連する名言 -->
        @if($relatedQuotes->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">関連する名言</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($relatedQuotes as $related)
                        <div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition">
                            <blockquote class="text-sm text-gray-800 italic mb-3">"{{ Str::limit($related->quote_text, 80) }}"</blockquote>
                            <p class="text-xs text-gray-600 mb-2">- {{ $related->author->name }}</p>
                            <a href="{{ route('quotes.show', $related->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ナビゲーションボタン -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <a href="{{ route('largecategories.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 名言・格言トップに戻る
            </a>
            <a href="{{ route('authors.show', $quote->author->id) }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                {{ $quote->author->name }}の名言一覧
            </a>
            <a href="{{ route('categories.show', $quote->category->id) }}" 
               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                {{ $quote->category->name }}の名言一覧
            </a>
            <a href="{{ route('quotes.popular') }}" 
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                人気の名言ランキング
            </a>
        </div>

        <!-- 同じ著者の他の名言 -->
        @php
            $authorQuotes = App\Models\Quote::where('author_id', $quote->author_id)
                                           ->where('id', '!=', $quote->id)
                                           ->limit(6)
                                           ->get();
        @endphp
        @if($authorQuotes->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">{{ $quote->author->name }}の他の名言</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($authorQuotes as $authorQuote)
                        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                            <blockquote class="text-lg text-gray-800 italic mb-4">"{{ Str::limit($authorQuote->quote_text, 120) }}"</blockquote>
                            <p class="text-sm text-gray-600 mb-4">
                                カテゴリ: 
                                <a href="{{ route('categories.show', $authorQuote->category->id) }}" 
                                   class="text-blue-600 hover:text-blue-800">{{ $authorQuote->category->name }}</a>
                            </p>
                            <a href="{{ route('quotes.show', $authorQuote->id) }}" 
                               class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                                詳細を見る
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('authors.show', $quote->author->id) }}" 
                       class="text-blue-600 hover:text-blue-800 font-semibold">{{ $quote->author->name }}の名言をもっと見る →</a>
                </div>
            </section>
        @endif
    </div>
@endsection