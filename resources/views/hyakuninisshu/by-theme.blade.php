{{-- resources/views/hyakuninisshu/by-theme.blade.php --}}
@extends('layouts.app')

@section('title', $theme . 'の歌 - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '百人一首', 'url' => route('hyakuninisshu.index')],
            ['name' => $theme . 'の歌']
        ]])

        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">{{ $theme }}の歌</h1>

        <!-- テーマ別リンク -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            @foreach(['恋', '自然', '人生', '別れ', '思慕'] as $themeItem)
                <a href="{{ route('hyakuninisshu.by-theme', $themeItem) }}" 
                   class="@if($themeItem === $theme) bg-purple-200 @else bg-purple-100 hover:bg-purple-200 @endif transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-purple-800">{{ $themeItem }}</span>
                </a>
            @endforeach
        </div>

        <!-- 歌一覧 -->
        @if($poems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($poems as $poem)
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                        <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                        <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                        <p class="text-sm text-gray-600 mb-2">歌人: 
                            <a href="{{ route('poets.show', $poem->poet->id) }}" class="text-blue-500">
                                {{ $poem->poet->name }}
                            </a>
                        </p>
                        @if($poem->season)
                            <p class="text-sm text-gray-600 mb-4">季節: {{ $poem->season }}</p>
                        @endif
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-gray-700 text-center">{{ $theme }}の歌は見つかりませんでした。</p>
        @endif
    </div>
@endsection