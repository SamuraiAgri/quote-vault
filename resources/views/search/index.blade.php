@extends('layout')

@section('title', '検索結果')

@section('content')
    <div class="container mx-auto px-4">
        <!-- 検索フォーム -->
        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4">検索</h1>
            <form action="{{ route('search.index') }}" method="GET" class="flex items-center gap-4">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="キーワードを入力"
                    class="flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    検索
                </button>
            </form>
        </div>

        <!-- 検索結果 -->
        @if (is_null($results))
            <p class="text-gray-700 text-center">検索キーワードを入力してください。</p>
        @elseif ($results->isEmpty())
            <p class="text-gray-700 text-center">「{{ $keyword }}」に一致する名言は見つかりませんでした。</p>
        @else
            <p class="text-gray-700 mb-4">「{{ $keyword }}」の検索結果: {{ $results->total() }}件</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($results as $quote)
                    <div class="bg-white shadow rounded-lg p-6">
                        <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                        <p class="text-sm text-gray-600">著者: 
                            <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-500">
                                {{ $quote->author->name }}
                            </a>
                        </p>
                        <p class="text-sm text-gray-600">カテゴリ: 
                            <a href="{{ route('categories.show', $quote->category->id) }}" class="text-blue-500">
                                {{ $quote->category->name }}
                            </a>
                        </p>
                        <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
