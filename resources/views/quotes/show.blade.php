@extends('layout')

@section('title', '名言詳細')

@section('content')
    <div class="container mx-auto px-4">
        <!-- 名言 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-6">{{ $quote->author->name }}の名言</h1>
            <blockquote class="text-2xl text-gray-800 italic">"{{ $quote->quote_text }}"</blockquote>
        </div>

        <!-- 詳細情報 -->
        <div class="bg-gray-100 shadow rounded-lg p-6">
            <p class="text-lg text-gray-600 mb-4">
                著者: 
                <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-500 underline">
                    {{ $quote->author->name }}
                </a>
            </p>
            <p class="text-lg text-gray-600 mb-4">
                カテゴリ: 
                <a href="{{ route('categories.show', $quote->category->id) }}" class="text-blue-500 underline">
                    {{ $quote->category->name }}
                </a>
            </p>
            <p class="text-lg text-gray-600">
                最終アクセス日時: {{ $quote->last_accessed_at ?? 'なし' }}
            </p>
        </div>
    </div>
@endsection
