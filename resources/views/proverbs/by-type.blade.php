{{-- resources/views/proverbs/by-type.blade.php --}}
@extends('layouts.app')

@section('title', $typeName . '一覧')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => 'ことわざ・四字熟語', 'url' => route('proverbs.index')],
            ['name' => $typeName]
        ]])

        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">{{ $typeName }}一覧</h1>

        <!-- 種類別リンク -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            @foreach(['ことわざ', '四字熟語', '慣用句'] as $typeItem)
                <a href="{{ route('proverbs.by-type', $typeItem) }}" 
                   class="@if($typeItem === $type) bg-blue-200 @else bg-blue-100 hover:bg-blue-200 @endif transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-blue-800">{{ $typeItem }}</span>
                </a>
            @endforeach
        </div>

        <!-- ことわざ・四字熟語一覧 -->
        @if($proverbs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($proverbs as $proverb)
                    <div class="bg-white shadow rounded-lg p-6">
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $proverb->reading }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 80) }}</p>
                        
                        @if($proverb->category)
                            <p class="text-xs text-gray-600 mb-4">
                                カテゴリ: 
                                <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" class="text-blue-500">
                                    {{ $proverb->category->name }}
                                </a>
                            </p>
                        @endif
                        
                        <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-gray-700 text-center">{{ $typeName }}は見つかりませんでした。</p>
        @endif
    </div>
@endsection