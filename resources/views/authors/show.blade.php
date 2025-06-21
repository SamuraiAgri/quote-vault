{{-- resources/views/authors/show.blade.php --}}
@extends('layout')

@section('title', $author->name . ' - 著者詳細')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('largecategories.index') }}" class="hover:text-blue-600">名言・格言</a></li>
                <li>›</li>
                <li><a href="{{ route('authors.index') }}" class="hover:text-blue-600">著者一覧</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $author->name }}</li>
            </ol>
        </nav>

        <!-- 著者情報 -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 shadow-lg rounded-lg p-8 mb-8 text-center">
            <h1 class="text-4xl font-bold text-blue-800 mb-4">{{ $author->name }}</h1>
            @if($author->furigana)
                <p class="text-xl text-gray-700 mb-4">{{ $author->furigana }}</p>
            @endif
            
            <div class="flex justify-center items-center space-x-4 mb-6">
                <span class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold">
                    {{ $author->quotes->count() }}個の名言
                </span>
            </div>

            @if($author->bio)
                <div class="bg-white bg-opacity-70 rounded-lg p-6 max-w-4xl mx-auto">
                    <h2 class="text-lg font-semibold text-blue-800 mb-3">著者について</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $author->bio }}</p>
                </div>
            @endif
        </div>

        <!-- 名言一覧 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">{{ $author->name }}の名言一覧</h2>
            
            @if($author->quotes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($author->quotes as $quote)
                        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition border-l-4 border-blue-500">
                            <!-- 名言本文 -->
                            <blockquote class="text-lg text-gray-800 italic mb-4 leading-relaxed">
                                "{{ $quote->quote_text }}"
                            </blockquote>
                            
                            <!-- カテゴリ情報 -->
                            <div class="mb-4">
                                <p class="text-sm text-gray-600">
                                    カテゴリ: 
                                    <a href="{{ route('categories.show', $quote->category->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-semibold">
                                        {{ $quote->category->name }}
                                    </a>
                                </p>
                                @if($quote->category->largeCategory)
                                    <p class="text-xs text-gray-500">
                                        <a href="{{ route('largecategories.show', $quote->category->largeCategory->id) }}" 
                                           class="hover:text-blue-600">
                                            {{ $quote->category->largeCategory->name }}
                                        </a>
                                    </p>
                                @endif
                            </div>

                            <!-- アクション -->
                            <div class="flex justify-between items-center pt-4 border-t">
                                <span class="text-xs text-gray-500">{{ $quote->popular_score }}pt</span>
                                <a href="{{ route('quotes.show', $quote->id) }}" 
                                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                                    詳細を見る
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <p class="text-gray-600">この著者の名言は現在登録されていません。</p>
                </div>
            @endif
        </section>

        <!-- カテゴリ別名言数 -->
        @if($author->quotes->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-blue-800">カテゴリ別名言数</h2>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @php
                            $categoryGroups = $author->quotes->groupBy('category.name');
                        @endphp
                        @foreach($categoryGroups as $categoryName => $quotes)
                            @php
                                $category = $quotes->first()->category;
                            @endphp
                            <a href="{{ route('categories.show', $category->id) }}" 
                               class="bg-blue-50 hover:bg-blue-100 rounded-lg p-3 text-center transition">
                                <div class="font-bold text-blue-800 text-sm">{{ $categoryName }}</div>
                                <div class="text-xs text-blue-600 mt-1">{{ $quotes->count() }}件</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- ナビゲーション -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('authors.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 著者一覧に戻る
            </a>
            <a href="{{ route('largecategories.index') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                名言・格言トップに戻る
            </a>
            <a href="{{ route('quotes.popular') }}" 
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                人気の名言ランキング
            </a>
        </div>

        <!-- 関連著者 -->
        @php
            // 同じカテゴリの名言を持つ他の著者を取得
            $relatedAuthors = App\Models\Author::whereHas('quotes', function($query) use ($author) {
                $categoryIds = $author->quotes->pluck('category_id')->unique();
                $query->whereIn('category_id', $categoryIds);
            })
            ->where('id', '!=', $author->id)
            ->withCount('quotes')
            ->limit(6)
            ->get();
        @endphp
        @if($relatedAuthors->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-blue-800">関連する著者</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($relatedAuthors as $relatedAuthor)
                        <a href="{{ route('authors.show', $relatedAuthor->id) }}" 
                           class="bg-white hover:bg-blue-50 shadow-lg rounded-lg p-4 text-center transition hover:shadow-xl">
                            <div class="font-bold text-blue-800 text-sm mb-1">{{ $relatedAuthor->name }}</div>
                            <div class="text-xs text-gray-600">{{ $relatedAuthor->quotes_count }}個の名言</div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection