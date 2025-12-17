@extends('layout')

@section('title', $category->name)

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '名言・格言', 'url' => route('largecategories.index')],
            ['name' => $category->largeCategory->name ?? 'カテゴリ', 'url' => route('largecategories.show', $category->largeCategory->id ?? 1)],
            ['name' => $category->name]
        ]])

        <!-- カテゴリ名 -->
        <h1 class="text-3xl font-bold text-center mb-6">{{ $category->name }}</h1>

        <!-- 名言一覧 -->
        <h2 class="text-2xl font-semibold mb-4">名言一覧</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($category->quotes as $quote)
                <div class="bg-white shadow rounded-lg p-6">
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                    <p class="text-sm text-gray-600">
                        著者: 
                        <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-500">
                            {{ $quote->author->name }}
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
