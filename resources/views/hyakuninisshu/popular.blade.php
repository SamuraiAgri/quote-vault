{{-- resources/views/hyakuninisshu/popular.blade.php --}}
@extends('layouts.app')

@section('title', '人気の百人一首ランキング')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '百人一首', 'url' => route('hyakuninisshu.index')],
            ['name' => '人気ランキング']
        ]])

        <h1 class="text-3xl font-semibold mb-6 text-center">人気の百人一首ランキング</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularPoems as $index => $poem)
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- ランキング順位 -->
                    <div class="text-blue-600 font-bold text-2xl mb-2">{{ $index + 1 }}位</div>
                    
                    <!-- 番号 -->
                    <div class="text-lg text-blue-600 font-bold mb-2">第{{ $poem->number }}番</div>

                    <!-- 歌 -->
                    <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                    <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>

                    <!-- 歌人 -->
                    <p class="text-sm text-gray-600 mb-2">
                        歌人: 
                        <a href="{{ route('poets.show', $poem->poet->id) }}" class="text-blue-500">
                            {{ $poem->poet->name }}
                        </a>
                    </p>

                    <!-- 季節・テーマ -->
                    @if($poem->season)
                        <p class="text-sm text-gray-600 mb-2">季節: {{ $poem->season }}</p>
                    @endif
                    @if($poem->theme)
                        <p class="text-sm text-gray-600 mb-2">テーマ: {{ $poem->theme }}</p>
                    @endif

                    <!-- アクセス数 -->
                    <p class="text-sm text-gray-600 mb-4">アクセス数: {{ $poem->access_count }}</p>

                    <!-- 詳細ページリンク -->
                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection