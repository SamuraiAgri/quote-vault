@extends('layout')

@section('title', '人気の名言ランキング')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold mb-6 text-center">人気の名言ランキング</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularRankQuotes as $index => $quote)
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- ランキング順位 -->
                    <div class="text-blue-600 font-bold text-2xl mb-2">{{ $index + 1 }}位</div>

                    <!-- 名言 -->
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>

                    <!-- 著者 -->
                    <p class="text-sm text-gray-600">
                        著者: 
                        <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-500">
                            {{ $quote->author->name }}
                        </a>
                    </p>

                    <!-- アクセス数 -->
                    <p class="text-sm text-gray-600">アクセス数: {{ $quote->popular_score }}</p>

                    <!-- 詳細ページリンク -->
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
