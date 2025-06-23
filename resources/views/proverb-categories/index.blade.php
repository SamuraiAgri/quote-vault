{{-- resources/views/proverb-categories/index.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語カテゴリ一覧')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">ことわざ・四字熟語カテゴリ一覧</h1>
        <p class="text-gray-600 text-center mb-8">テーマ別にことわざ・四字熟語・慣用句を探すことができます。</p>

        <!-- カテゴリ一覧 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div class="bg-white shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                    <h3 class="text-lg font-bold text-blue-800 mb-2">{{ $category->name }}</h3>
                    
                    @if($category->description)
                        <p class="text-sm text-gray-600 mb-4">{{ $category->description }}</p>
                    @endif
                    
                    <!-- アイテム数 -->
                    <p class="text-sm text-gray-600 mb-4">{{ $category->proverbs_count }}件</p>
                    
                    <a href="{{ route('proverb-categories.show', $category->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                        一覧を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection