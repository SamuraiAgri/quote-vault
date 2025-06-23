{{-- resources/views/hyakuninisshu/by-season.blade.php --}}
@extends('layout')

@section('title', $season . 'の歌 - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        <!-- ページタイトル -->
        <h1 class="text-3xl font-bold text-center mb-6">{{ $season }}の歌</h1>

        <!-- 季節別リンク -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach(['春', '夏', '秋', '冬'] as $seasonItem)
                <a href="{{ route('hyakuninisshu.by-season', $seasonItem) }}" 
                   class="@if($seasonItem === $season) bg-green-200 @else bg-green-100 hover:bg-green-200 @endif transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-green-800">{{ $seasonItem }}</span>
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
                        @if($poem->theme)
                            <p class="text-sm text-gray-600 mb-4">テーマ: {{ $poem->theme }}</p>
                        @endif
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-gray-700 text-center">{{ $season }}の歌は見つかりませんでした。</p>
        @endif
    </div>
@endsection