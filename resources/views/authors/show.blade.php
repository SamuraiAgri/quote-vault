@extends('layout')

@section('title', $author->name)

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '名言・格言', 'url' => route('largecategories.index')],
            ['name' => '著者一覧', 'url' => route('authors.index')],
            ['name' => $author->name]
        ]])

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
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
