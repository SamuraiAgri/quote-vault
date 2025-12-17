@extends('layout')

@section('title', '404 - ページが見つかりません')

@section('robots', 'noindex, nofollow')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">
        {{-- 404アイコン --}}
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">ページが見つかりません</h2>
        <p class="text-gray-600 mb-8">
            お探しのページは移動または削除された可能性があります。<br>
            URLが正しいかご確認ください。
        </p>

        {{-- 検索ボックス --}}
        <div class="mb-8">
            <p class="text-gray-600 mb-4">キーワードで検索してみてください：</p>
            @include('components.search-form', [
                'action' => route('search.index'),
                'placeholder' => '名言・ことわざ・百人一首を検索...'
            ])
        </div>

        {{-- ナビゲーションリンク --}}
        <div class="space-y-4">
            <p class="text-gray-600">または、以下のページをご覧ください：</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    ホームへ戻る
                </a>
                <a href="{{ route('largecategories.index') }}" 
                   class="inline-flex items-center gap-2 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg transition">
                    名言・格言
                </a>
                <a href="{{ route('proverbs.index') }}" 
                   class="inline-flex items-center gap-2 border-2 border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-lg transition">
                    ことわざ・四字熟語
                </a>
                <a href="{{ route('hyakuninisshu.index') }}" 
                   class="inline-flex items-center gap-2 border-2 border-purple-600 text-purple-600 hover:bg-purple-50 px-6 py-3 rounded-lg transition">
                    百人一首
                </a>
            </div>
        </div>

        {{-- 人気コンテンツ --}}
        <div class="mt-12 text-left">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">人気のコンテンツ</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('quotes.popular') }}" class="bg-blue-50 hover:bg-blue-100 p-4 rounded-lg transition">
                    <h4 class="font-medium text-blue-800">人気の名言</h4>
                    <p class="text-sm text-gray-600">多くの人に読まれている名言</p>
                </a>
                <a href="{{ route('proverbs.popular') }}" class="bg-green-50 hover:bg-green-100 p-4 rounded-lg transition">
                    <h4 class="font-medium text-green-800">人気のことわざ</h4>
                    <p class="text-sm text-gray-600">よく調べられていることわざ</p>
                </a>
                <a href="{{ route('hyakuninisshu.popular') }}" class="bg-purple-50 hover:bg-purple-100 p-4 rounded-lg transition">
                    <h4 class="font-medium text-purple-800">人気の百人一首</h4>
                    <p class="text-sm text-gray-600">注目されている和歌</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
