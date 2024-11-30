@extends('layout')

@section('title', $largeCategory->name)

@section('content')
    <div class="container mx-auto px-4">
        <!-- 大カテゴリ名 -->
        <h1 class="text-3xl font-bold text-center mb-6">{{ $largeCategory->name }}</h1>

        <!-- カテゴリ一覧 -->
        <h2 class="text-2xl font-semibold mb-4">カテゴリ一覧</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($largeCategory->categories as $category)
                <div class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-lg font-bold text-blue-800">
                        {{ $category->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
