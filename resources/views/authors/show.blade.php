@extends('layout')

@section('title', $author->name)

@section('content')
    <div class="container mx-auto px-4">
        <!-- 著者情報 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $author->name }}</h1>
            <p class="text-gray-700">{{ $author->bio }}</p>
        </div>

        <!-- 名言一覧 -->
        <h2 class="text-2xl font-semibold mb-4">名言一覧</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($author->quotes as $quote)
                <div class="bg-gray-100 hover:bg-gray-200 transition rounded-lg p-4 shadow">
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                    <p class="text-sm text-gray-600">
                        カテゴリ: 
                        <a href="{{ route('categories.show', $quote->category->id) }}" class="text-blue-500">
                            {{ $quote->category->name }}
                        </a>
                    </p>
                    <a href="{{ route('quotes.show', $quote->id) }}" class="text-blue-500 underline mt-4 block">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
