{{-- ファイルパス: resources/views/proverb-categories/show.blade.php --}}
@extends('layout')

@section('title', $category->name . ' - ことわざ・四字熟語カテゴリ')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.index') }}" class="hover:text-blue-600">ことわざ・四字熟語辞典</a></li>
                <li>›</li>
                <li><a href="{{ route('proverb-categories.index') }}" class="hover:text-blue-600">カテゴリ一覧</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- カテゴリ情報 -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 shadow-lg rounded-lg p-8 mb-8 text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg text-gray-700 mb-4">{{ $category->description }}</p>
            @endif
            <div class="flex justify-center space-x-4">
                <span class="bg-blue-500 text-white px-4 py-2 rounded-full font-semibold">
                    {{ $proverbs->total() }}件のことわざ・四字熟語
                </span>
            </div>
        </div>

        <!-- 種類別フィルター -->
        <div class="mb-6">
            <div class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('proverb-categories.show', $category->id) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                    すべて
                </a>
                <a href="{{ route('proverb-categories.show', $category->id) }}?type=ことわざ" 
                   class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm transition">
                    ことわざ
                </a>
                <a href="{{ route('proverb-categories.show', $category->id) }}?type=四字熟語" 
                   class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm transition">
                    四字熟語
                </a>
                <a href="{{ route('proverb-categories.show', $category->id) }}?type=慣用句" 
                   class="bg-gray-200 text-gray-700 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm transition">
                    慣用句
                </a>
            </div>
        </div>

        <!-- ことわざ・四字熟語一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($proverbs as $proverb)
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-bold text-gray-800">{{ $proverb->word }}</h3>
                        <span class="bg-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-100 
                                    text-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-800 
                                    px-2 py-1 rounded text-xs font-semibold">
                            {{ $proverb->type }}
                        </span>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                    <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 120) }}</p>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $proverb->access_count }}回閲覧</span>
                        <a href="{{ route('proverbs.show', $proverb->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold text-sm">詳細を見る →</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        @if($proverbs->hasPages())
            <div class="mb-8">
                {{ $proverbs->links() }}
            </div>
        @endif

        <!-- ナビゲーションボタン -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('proverb-categories.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← カテゴリ一覧に戻る
            </a>
            <a href="{{ route('proverbs.index') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                ことわざ・四字熟語辞典トップ
            </a>
        </div>
    </div>
@endsection