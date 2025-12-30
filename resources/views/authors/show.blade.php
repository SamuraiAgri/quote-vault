{{-- resources/views/authors/show-new.blade.php --}}
{{-- リニューアルされた著者詳細ページ --}}
@extends('layouts.app')

@section('title', $author->name . 'の名言・格言一覧 | Quote Vault')

@section('meta_description', $author->name . 'の名言・格言を一覧で紹介。人生に影響を与える言葉を見つけましょう。')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "{{ $author->name }}",
    "description": "{{ $author->bio ?? $author->name . 'の名言・格言を紹介' }}"
}
</script>
@endsection

@section('content')
<div class="space-y-8">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => '偉人一覧', 'url' => route('authors.index')],
        ['name' => $author->name]
    ]])

    {{-- 著者プロフィール --}}
    <section class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 rounded-3xl overflow-hidden">
        <div class="p-8 md:p-12 text-white">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                {{-- アバター --}}
                <div class="w-28 h-28 md:w-36 md:h-36 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center text-5xl md:text-6xl font-bold flex-shrink-0 shadow-2xl border border-white/30">
                    {{ mb_substr($author->name, 0, 1) }}
                </div>
                
                <div class="text-center md:text-left flex-1">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $author->name }}</h1>
                    @if($author->furigana)
                    <p class="text-blue-200 mb-4">{{ $author->furigana }}</p>
                    @endif
                    
                    @if($author->bio)
                    <p class="text-blue-100 leading-relaxed max-w-2xl">{{ $author->bio }}</p>
                    @endif
                    
                    <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2">
                            <span class="text-blue-200 text-sm">名言数</span>
                            <p class="text-2xl font-bold">{{ $author->quotes->count() }}</p>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2">
                            <span class="text-blue-200 text-sm">総閲覧数</span>
                            <p class="text-2xl font-bold">{{ number_format($author->quotes->sum('access_count')) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SNS共有ボタン --}}
    <div class="flex justify-center">
        @include('components.share-buttons', [
            'title' => $author->name . 'の名言・格言',
            'url' => url()->current()
        ])
    </div>

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

    {{-- 名言一覧 --}}
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </span>
            {{ $author->name }}の名言一覧
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($author->quotes as $quote)
            <article class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 border-l-4 border-l-blue-500">
                <div class="p-6">
                    {{-- カテゴリバッジ --}}
                    <div class="flex items-center justify-between mb-4">
                        <a href="{{ route('categories.show', $quote->category->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
                            {{ $quote->category->name }}
                        </a>
                        <span class="text-xs text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($quote->access_count) }}
                        </span>
                    </div>
                    
                    {{-- 名言本文 --}}
                    <blockquote class="text-lg text-gray-800 leading-relaxed mb-4">
                        "{{ $quote->quote_text }}"
                    </blockquote>
                </div>
                
                {{-- フッター --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('quotes.show', $quote->id) }}" class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl text-blue-600 hover:bg-blue-600 hover:text-white border-2 border-blue-600 transition-all duration-300">
                        詳細を見る
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    {{-- 関連する著者 --}}
    <section class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-3xl p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">他の偉人を見る</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('authors.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-blue-100 border border-gray-200 hover:border-blue-300 text-gray-700 hover:text-blue-700 px-4 py-2 rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                偉人一覧へ戻る
            </a>
            <a href="{{ route('random.quote') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                ランダムで名言を見る
            </a>
        </div>
    </section>
</div>
@endsection
