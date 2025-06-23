{{-- resources/views/proverbs/show.blade.php --}}
@extends('layout')

@section('title', $proverb->word)

@section('content')
    <div class="container mx-auto px-4">
        <!-- ことわざ・四字熟語の詳細 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded mb-4">{{ $proverb->type }}</span>
            <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $proverb->word }}</h1>
            <p class="text-lg text-gray-600 mb-6">{{ $proverb->reading }}</p>
        </div>

        <!-- 意味と用例 -->
        <div class="bg-gray-100 shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">意味</h2>
            <p class="text-lg text-gray-800 mb-6">{{ $proverb->meaning }}</p>
            
            @if($proverb->example)
                <h2 class="text-2xl font-semibold mb-4">用例</h2>
                <p class="text-lg text-gray-800">{{ $proverb->example }}</p>
            @endif
        </div>

        <!-- 詳細情報 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">詳細情報</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p class="text-lg text-gray-600">
                    種類: <span class="font-semibold">{{ $proverb->type }}</span>
                </p>
                @if($proverb->category)
                    <p class="text-lg text-gray-600">
                        カテゴリ: 
                        <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" class="text-blue-500 underline">
                            {{ $proverb->category->name }}
                        </a>
                    </p>
                @endif
                <p class="text-lg text-gray-600">アクセス数: {{ $proverb->access_count }}</p>
                @if($proverb->last_accessed_at)
                    <p class="text-lg text-gray-600">最終アクセス: {{ $proverb->last_accessed_at->format('Y年m月d日') }}</p>
                @endif
            </div>
        </div>

        <!-- 関連のことわざ・四字熟語 -->
        @if($relatedProverbs->count() > 0)
            <section>
                <h2 class="text-2xl font-semibold mb-4">関連のことわざ・四字熟語</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProverbs as $relatedProverb)
                        <div class="bg-white shadow rounded-lg p-6">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $relatedProverb->type }}</span>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $relatedProverb->word }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $relatedProverb->reading }}</p>
                            <p class="text-sm text-gray-700 mb-4">{{ Str::limit($relatedProverb->meaning, 60) }}</p>
                            <a href="{{ route('proverbs.show', $relatedProverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                                詳細を見る
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection