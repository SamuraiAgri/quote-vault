{{-- resources/views/proverb-categories/show.blade.php --}}
@extends('layout')

@section('title', $category->name . ' - ことわざ・四字熟語')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => 'ことわざ・四字熟語', 'url' => route('proverbs.index')],
            ['name' => 'カテゴリ一覧', 'url' => route('proverb-categories.index')],
            ['name' => $category->name]
        ]])

        <!-- カテゴリ情報 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $category->name }}</h1>
            
            @if($category->description)
                <p class="text-lg text-gray-600 mb-4">{{ $category->description }}</p>
            @endif
            
            <p class="text-lg text-gray-600">{{ $proverbs->total() }}件のことわざ・四字熟語・慣用句</p>
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
                        
                        <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-gray-700 text-center">このカテゴリにはことわざ・四字熟語がありません。</p>
        @endif
    </div>
@endsection