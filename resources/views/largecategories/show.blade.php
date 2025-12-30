{{-- resources/views/largecategories/show-new.blade.php --}}
{{-- リニューアルされた大カテゴリ詳細ページ --}}
@extends('layouts.app')

@section('title', $largeCategory->name . 'の名言・格言 | Quote Vault')

@section('meta_description', $largeCategory->name . 'に関する名言・格言をテーマ別にご紹介。心に響く言葉を見つけましょう。')

@section('content')
<div class="space-y-8">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => $largeCategory->name]
    ]])

    {{-- ページヘッダー --}}
    <section class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 md:p-12 text-white">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">{{ $largeCategory->name }}</h1>
                <p class="text-indigo-200">{{ $largeCategory->categories->count() }}個のテーマ</p>
            </div>
        </div>
        <p class="text-indigo-100 max-w-2xl">
            {{ $largeCategory->description ?? '「' . $largeCategory->name . '」に関する名言・格言をさらに細かいテーマ別にご紹介します。' }}
        </p>
    </section>

    {{-- サブカテゴリ一覧 --}}
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">テーマを選ぶ</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($largeCategory->categories as $category)
            <a 
                href="{{ route('categories.show', $category->id) }}" 
                class="group bg-white hover:bg-indigo-50 rounded-xl p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-indigo-200 text-center"
            >
                <h3 class="font-bold text-gray-800 group-hover:text-indigo-700 transition-colors mb-2">
                    {{ $category->name }}
                </h3>
                <p class="text-sm text-gray-400">
                    {{ $category->quotes->count() }}件
                </p>
            </a>
            @endforeach
        </div>
    </section>

    {{-- 広告スペース --}}
    <div class="bg-gray-100 rounded-2xl p-4 text-center">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-8001546494492220"
             data-ad-slot="auto"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    {{-- このカテゴリの人気名言 --}}
    @php
    $popularQuotesInCategory = \App\Models\Quote::whereIn('category_id', $largeCategory->categories->pluck('id'))
        ->with(['author', 'category'])
        ->orderBy('access_count', 'desc')
        ->take(6)
        ->get();
    @endphp
    
    @if($popularQuotesInCategory->count() > 0)
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <span class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </span>
            「{{ $largeCategory->name }}」の人気名言
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularQuotesInCategory as $quote)
            <article class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <a href="{{ route('categories.show', $quote->category_id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition-colors">
                            {{ $quote->category->name }}
                        </a>
                        <span class="text-xs text-gray-400">{{ number_format($quote->access_count) }}回閲覧</span>
                    </div>
                    
                    <blockquote class="text-lg text-gray-800 leading-relaxed mb-4 line-clamp-3">
                        "{{ $quote->quote_text }}"
                    </blockquote>
                    
                    <a href="{{ route('authors.show', $quote->author->id) }}" class="text-sm text-gray-600 hover:text-indigo-600 transition-colors flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold">
                            {{ mb_substr($quote->author->name, 0, 1) }}
                        </div>
                        {{ $quote->author->name }}
                    </a>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl text-indigo-600 hover:bg-indigo-600 hover:text-white border-2 border-indigo-600 transition-all duration-300">
                        詳細を見る
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif

    {{-- 他のカテゴリへの誘導 --}}
    <section class="bg-gradient-to-r from-gray-50 to-purple-50 rounded-3xl p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">他のテーマを見る</h2>
        <div class="flex flex-wrap gap-3">
            @foreach(\App\Models\LargeCategory::where('id', '!=', $largeCategory->id)->take(5)->get() as $otherCat)
            <a href="{{ route('largecategories.show', $otherCat->id) }}" class="inline-flex items-center gap-2 bg-white hover:bg-purple-100 border border-gray-200 hover:border-purple-300 text-gray-700 hover:text-purple-700 px-4 py-2 rounded-xl transition-all">
                {{ $otherCat->name }}
            </a>
            @endforeach
            <a href="{{ route('largecategories.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl transition-all">
                すべて見る →
            </a>
        </div>
    </section>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
