{{-- ファイルパス: resources/views/proverbs/show.blade.php --}}
@extends('layout')

@section('title', $proverb->word . ' - ことわざ・四字熟語辞典')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.index') }}" class="hover:text-blue-600">ことわざ・四字熟語辞典</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.by-type', $proverb->type) }}" class="hover:text-blue-600">{{ $proverb->type }}</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $proverb->word }}</li>
            </ol>
        </nav>

        <!-- メイン詳細 -->
        <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
            <!-- ヘッダー情報 -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $proverb->word }}</h1>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $proverb->type }}
                    </span>
                </div>
                <p class="text-lg text-gray-600 mb-2">
                    <span class="font-semibold">読み:</span> {{ $proverb->reading }}
                </p>
                @if($proverb->category)
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">カテゴリ:</span> 
                        <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" 
                           class="text-blue-600 hover:text-blue-800">{{ $proverb->category->name }}</a>
                    </p>
                @endif
            </div>

            <!-- 意味 -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-blue-500 pl-3">意味</h2>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $proverb->meaning }}</p>
            </div>

            <!-- 用例 -->
            @if($proverb->example)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-l-4 border-green-500 pl-3">用例</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 leading-relaxed">{{ $proverb->example }}</p>
                    </div>
                </div>
            @endif

            <!-- アクセス情報 -->
            <div class="border-t pt-4 text-sm text-gray-500">
                <p>アクセス数: {{ $proverb->access_count }}回</p>
                @if($proverb->last_accessed_at)
                    <p>最終アクセス: {{ $proverb->last_accessed_at->format('Y年m月d日 H:i') }}</p>
                @endif
            </div>
        </div>

        <!-- 関連のことわざ・四字熟語 -->
        @if($relatedProverbs->count() > 0)
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">関連する{{ $proverb->category ? $proverb->category->name : $proverb->type }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($relatedProverbs as $related)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold text-gray-800 mb-2">{{ $related->word }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $related->reading }}</p>
                            <p class="text-xs text-gray-600 mb-3">{{ Str::limit($related->meaning, 80) }}</p>
                            <a href="{{ route('proverbs.show', $related->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">詳細を見る →</a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ナビゲーションボタン -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('proverbs.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← トップに戻る
            </a>
            <a href="{{ route('proverbs.by-type', $proverb->type) }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                {{ $proverb->type }}一覧を見る
            </a>
            @if($proverb->category)
                <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                    {{ $proverb->category->name }}一覧を見る
                </a>
            @endif
        </div>
    </div>
@endsection