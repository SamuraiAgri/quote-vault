@extends('layout')

@section('title', '今日の名言・ことわざ・百人一首 | 毎日更新')

@section('meta_description', '毎日更新される名言・ことわざ・百人一首をお届けします。新しい言葉との出会いを楽しんでください。')

@section('content')
<div class="container mx-auto px-4">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '今日のおすすめ']
    ]])

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">今日のおすすめ</h1>
        <p class="text-gray-600">{{ date('Y年n月j日') }} の言葉</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- 今日の名言 --}}
        @if($dailyQuote)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-4 py-3">
                <h2 class="text-lg font-semibold">📜 今日の名言</h2>
            </div>
            <div class="p-6">
                <blockquote class="text-lg text-gray-800 italic mb-4 line-clamp-4">
                    "{{ $dailyQuote->quote_text }}"
                </blockquote>
                <p class="text-sm text-gray-600 mb-4">- {{ $dailyQuote->author->name }}</p>
                <div class="flex justify-between items-center">
                    <a href="{{ route('quotes.show', $dailyQuote->id) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        詳細を見る →
                    </a>
                    @include('components.favorite-button', ['id' => $dailyQuote->id, 'type' => 'quote'])
                </div>
            </div>
        </div>
        @endif

        {{-- 今日のことわざ --}}
        @if($dailyProverb)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white px-4 py-3">
                <h2 class="text-lg font-semibold">🌿 今日の{{ $dailyProverb->type }}</h2>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $dailyProverb->word }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ $dailyProverb->reading }}</p>
                <p class="text-gray-700 mb-4 line-clamp-3">{{ $dailyProverb->meaning }}</p>
                <div class="flex justify-between items-center">
                    <a href="{{ route('proverbs.show', $dailyProverb->id) }}" 
                       class="text-green-600 hover:text-green-800 font-medium">
                        詳細を見る →
                    </a>
                    @include('components.favorite-button', ['id' => $dailyProverb->id, 'type' => 'proverb'])
                </div>
            </div>
        </div>
        @endif

        {{-- 今日の百人一首 --}}
        @if($dailyPoem)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-purple-600 text-white px-4 py-3">
                <h2 class="text-lg font-semibold">🎋 今日の百人一首</h2>
            </div>
            <div class="p-6">
                <div class="text-purple-600 font-bold text-sm mb-2">第{{ $dailyPoem->number }}番</div>
                <p class="text-lg text-gray-800 mb-1">{{ $dailyPoem->upper_phrase }}</p>
                <p class="text-lg text-gray-800 mb-4">{{ $dailyPoem->lower_phrase }}</p>
                <p class="text-sm text-gray-600 mb-4">歌人: {{ $dailyPoem->poet->name }}</p>
                <div class="flex justify-between items-center">
                    <a href="{{ route('hyakuninisshu.show', $dailyPoem->id) }}" 
                       class="text-purple-600 hover:text-purple-800 font-medium">
                        詳細を見る →
                    </a>
                    @include('components.favorite-button', ['id' => $dailyPoem->id, 'type' => 'poem'])
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ランダム取得ボタン --}}
    <div class="mt-8 text-center">
        <p class="text-gray-600 mb-4">別の言葉を見たい場合は、下のボタンをクリックしてください</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('random.quote') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                ランダムな名言
            </a>
            <a href="{{ route('random.proverb') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition">
                ランダムなことわざ
            </a>
            <a href="{{ route('random.poem') }}" 
               class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition">
                ランダムな百人一首
            </a>
        </div>
    </div>
</div>
@endsection
