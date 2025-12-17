{{-- resources/views/poets/index.blade.php --}}
@extends('layout')

@section('title', '歌人一覧')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '百人一首', 'url' => route('hyakuninisshu.index')],
            ['name' => '歌人一覧']
        ]])

        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">歌人一覧</h1>
        <p class="text-gray-600 text-center mb-8">百人一首に登場する歌人たちの一覧です。</p>

        <!-- 歌人一覧 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($poets as $poet)
                <div class="bg-white shadow rounded-lg p-6 text-center hover:bg-gray-50 transition">
                    <h3 class="text-lg font-bold text-blue-800 mb-2">{{ $poet->name }}</h3>
                    
                    @if($poet->reading)
                        <p class="text-sm text-gray-600 mb-2">{{ $poet->reading }}</p>
                    @endif
                    
                    @if($poet->period)
                        <p class="text-sm text-gray-600 mb-4">{{ $poet->period }}</p>
                    @endif
                    
                    <!-- 歌の数 -->
                    <p class="text-sm text-gray-600 mb-4">歌の数: {{ $poet->hyakuninisshu_count }}首</p>
                    
                    <a href="{{ route('poets.show', $poet->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection