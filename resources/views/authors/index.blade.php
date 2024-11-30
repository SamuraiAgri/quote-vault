@extends('layout')

@section('title', '著者一覧')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">著者一覧</h1>

        <!-- 50音セクションごとの著者リスト -->
        @foreach ($groupedAuthors as $initial => $group)
            <div class="mb-8">
                <!-- セクションタイトル（頭文字） -->
                <h2 class="text-2xl font-semibold text-blue-800 mb-4">{{ $initial }}</h2>

                <!-- 著者リスト -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($group as $author)
                        <a href="{{ route('authors.show', $author->id) }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow block">
                            <span class="text-lg font-bold text-blue-800">{{ $author->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
