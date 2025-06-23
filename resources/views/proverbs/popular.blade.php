{{-- resources/views/proverbs/popular.blade.php --}}
@extends('layout')

@section('title', '人気のことわざ・四字熟語ランキング')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold mb-6 text-center">人気のことわざ・四字熟語ランキング</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularProverbs as $index => $proverb)
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- ランキング順位 -->
                    <div class="text-blue-600 font-bold text-2xl mb-2">{{ $index + 1 }}位</div>
                    
                    <!-- 種類 -->
                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $proverb->type }}</span>

                    <!-- 語句と読み -->
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $proverb->reading }}</p>

                    <!-- 意味 -->
                    <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 80) }}</p>

                    <!-- カテゴリ -->
                    @if($proverb->category)
                        <p class="text-xs text-gray-600 mb-2">
                            カテゴリ: 
                            <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" class="text-blue-500">
                                {{ $proverb->category->name }}
                            </a>
                        </p>
                    @endif

                    <!-- アクセス数 -->
                    <p class="text-xs text-gray-600 mb-4">アクセス数: {{ $proverb->access_count }}</p>

                    <!-- 詳細ページリンク -->
                    <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection