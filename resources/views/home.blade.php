{{-- resources/views/home-new.blade.php --}}
{{-- リニューアルされたトップページ --}}
@extends('layouts.app')

@section('title', '名言・格言・ことわざ・百人一首 | Quote Vault')

@section('meta_description', '10万件以上の名言・格言・ことわざ・四字熟語・百人一首を無料で検索。偉人や著者別、テーマ別、キーワード検索で心に響く言葉が見つかります。毎日更新の人気ランキングも。')

@section('meta_keywords', '名言,格言,ことわざ,四字熟語,慣用句,百人一首,偉人,著者,検索,無料,人気,ランキング,テーマ,カテゴリ,心に響く,座右の銘')

@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Quote Vault - 名言・格言・ことわざ・百人一首",
        "alternateName": "名言検索 Quote Vault",
        "url": "{{ url('/') }}",
        "description": "10万件以上の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を検索できる無料サイト",
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "{{ route('search.index') }}?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Quote Vault",
            "url": "{{ url('/') }}"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "名言・格言・ことわざ・百人一首コレクション",
        "description": "偉人の名言、格言、ことわざ、四字熟語、百人一首を網羅したコレクション",
        "url": "{{ url('/') }}",
        "isPartOf": {
            "@type": "WebSite",
            "url": "{{ url('/') }}"
        }
    }
    </script>
@endsection

@section('content')
    <div class="space-y-12 md:space-y-16">

        {{-- ヒーローセクション --}}
        <section class="relative overflow-hidden">
            <div class="text-center py-8 md:py-16">
                {{-- メインタイトル --}}
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    心に響く<span
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">言葉</span>を見つけよう
                </h1>
                <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto mb-8">
                    偉人の名言・格言、ことわざ・四字熟語、百人一首<br class="hidden md:block">
                    あなたの人生を彩る言葉がここにあります
                </p>

                {{-- クイック検索 --}}
                <div class="max-w-2xl mx-auto">
                    <quick-search></quick-search>
                </div>
            </div>
        </section>

        {{-- 探し方ナビゲーション --}}
        <section>
            <content-navigation></content-navigation>
        </section>

        {{-- 今日の名言 --}}
        @if(isset($dailyQuote) && $dailyQuote)
            <section>
                <daily-quote :quote='{!! json_encode([
                "text" => $dailyQuote->quote_text,
                "author" => $dailyQuote->author->name,
                "category" => $dailyQuote->category->name ?? "",
                "url" => route("quotes.show", $dailyQuote->id)
            ]) !!}'></daily-quote>
            </section>
        @endif

        {{-- ランダム名言ウィジェット --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <random-quote type="quote" title="ランダム名言" :initial-quote='{!! json_encode([
        "text" => $popularQuotes->first()->quote_text ?? "名言を読み込み中...",
        "author" => $popularQuotes->first()->author->name ?? "",
        "url" => $popularQuotes->first() ? route("quotes.show", $popularQuotes->first()->id) : "#"
    ]) !!}'></random-quote>

            <random-quote type="proverb" title="ランダムことわざ" :initial-quote='{!! json_encode([
        "text" => $popularProverbs->first()->word ?? "ことわざを読み込み中...",
        "author" => $popularProverbs->first()->reading ?? "",
        "url" => $popularProverbs->first() ? route("proverbs.show", $popularProverbs->first()->id) : "#"
    ]) !!}'></random-quote>

            <random-quote type="poem" title="ランダム百人一首" :initial-quote='{!! json_encode([
        "text" => ($popularPoems->first()->upper_phrase ?? "") . " " . ($popularPoems->first()->lower_phrase ?? ""),
        "author" => $popularPoems->first()->poet->name ?? "",
        "url" => $popularPoems->first() ? route("hyakuninisshu.show", $popularPoems->first()->id) : "#"
    ]) !!}'></random-quote>
        </section>

        {{-- 広告スペース --}}
        <div class="bg-gray-100 rounded-2xl p-4 text-center">
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8001546494492220" data-ad-slot="auto"
                data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        {{-- 人気の名言セクション --}}
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </span>
                    人気の名言
                </h2>
                <a href="{{ route('quotes.popular') }}"
                    class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 group">
                    もっと見る
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularQuotes as $quote)
                    <article
                        class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                        <div class="p-6">
                            {{-- カテゴリバッジ --}}
                            <div class="flex items-center justify-between mb-4">
                                <a href="{{ route('categories.show', $quote->category_id) }}"
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
                                    {{ $quote->category->name ?? 'カテゴリ' }}
                                </a>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ number_format($quote->access_count) }}
                                </span>
                            </div>

                            {{-- 名言本文 --}}
                            <blockquote class="text-lg text-gray-800 leading-relaxed mb-4 line-clamp-3">
                                "{{ $quote->quote_text }}"
                            </blockquote>

                            {{-- 著者 --}}
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center text-sm font-bold text-gray-600">
                                    {{ mb_substr($quote->author->name, 0, 1) }}
                                </div>
                                <a href="{{ route('authors.show', $quote->author->id) }}"
                                    class="text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                    {{ $quote->author->name }}
                                </a>
                            </div>
                        </div>

                        {{-- フッター --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <a href="{{ route('quotes.show', $quote->id) }}"
                                class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl text-blue-600 hover:bg-blue-600 hover:text-white border-2 border-blue-600 transition-all duration-300">
                                詳細を見る
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- テーマカテゴリ一覧 --}}
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </span>
                    テーマから探す
                </h2>
                <a href="{{ route('largecategories.index') }}"
                    class="text-purple-600 hover:text-purple-800 font-medium flex items-center gap-1 group">
                    すべて見る
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($largeCategories as $category)
                    <a href="{{ route('largecategories.show', $category->id) }}"
                        class="group relative bg-gradient-to-br from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 rounded-xl p-4 text-center border border-indigo-100 hover:border-indigo-200 transition-all duration-300 hover:shadow-md">
                        <span class="font-medium text-gray-800 group-hover:text-indigo-700 transition-colors">
                            {{ $category->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- 人気のことわざ・四字熟語 --}}
        @if($popularProverbs->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        人気のことわざ・四字熟語
                    </h2>
                    <a href="{{ route('proverbs.popular') }}"
                        class="text-green-600 hover:text-green-800 font-medium flex items-center gap-1 group">
                        もっと見る
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($popularProverbs as $proverb)
                        <article
                            class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 border-l-4 border-l-green-500">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        {{ $proverb->type }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $proverb->reading }}</p>
                                <p class="text-gray-700 text-sm line-clamp-2">{{ Str::limit($proverb->meaning, 80) }}</p>
                            </div>

                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <a href="{{ route('proverbs.show', $proverb->id) }}"
                                    class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl text-green-600 hover:bg-green-600 hover:text-white border-2 border-green-600 transition-all duration-300">
                                    意味を見る
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 人気の百人一首 --}}
        @if($popularPoems->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </span>
                        人気の百人一首
                    </h2>
                    <a href="{{ route('hyakuninisshu.popular') }}"
                        class="text-amber-600 hover:text-amber-800 font-medium flex items-center gap-1 group">
                        もっと見る
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($popularPoems as $poem)
                        <article
                            class="group bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-amber-100">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-200 text-amber-800">
                                        第{{ $poem->number }}番
                                    </span>
                                    @if($poem->season)
                                        <span class="text-xs text-amber-600">{{ $poem->season }}</span>
                                    @endif
                                </div>

                                <div class="font-serif text-lg text-gray-800 leading-relaxed mb-4">
                                    <p class="mb-1">{{ $poem->upper_phrase }}</p>
                                    <p>{{ $poem->lower_phrase }}</p>
                                </div>

                                <div class="flex items-center gap-3">
                                    <a href="{{ route('poets.show', $poem->poet_id) }}"
                                        class="text-sm text-amber-700 hover:text-amber-900 transition-colors flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 bg-amber-200 rounded-full flex items-center justify-center text-xs font-bold text-amber-700">
                                            {{ mb_substr($poem->poet->name, 0, 1) }}
                                        </div>
                                        {{ $poem->poet->name }}
                                    </a>
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-white/50 border-t border-amber-100">
                                <a href="{{ route('hyakuninisshu.show', $poem->id) }}"
                                    class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl text-amber-700 hover:bg-amber-600 hover:text-white border-2 border-amber-600 transition-all duration-300">
                                    詳細を見る
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 最近アクセスされた名言 --}}
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    最近人気の名言
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentQuotes as $quote)
                    <article
                        class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 group">
                        <blockquote class="text-gray-800 leading-relaxed mb-4 line-clamp-3">
                            "{{ $quote->quote_text }}"
                        </blockquote>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('authors.show', $quote->author->id) }}"
                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                — {{ $quote->author->name }}
                            </a>
                            <a href="{{ route('quotes.show', $quote->id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                詳細 →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- サイト説明 --}}
        <section class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 md:p-12 text-white">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Quote Vaultについて</h2>
                <p class="text-blue-100 leading-relaxed mb-6">
                    Quote Vaultは、偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。
                    人名別、テーマ別、キーワード検索であなたにぴったりの言葉が見つかります。
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('authors.index') }}"
                        class="inline-flex items-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-xl font-medium hover:bg-blue-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        偉人から探す
                    </a>
                    <a href="{{ route('largecategories.index') }}"
                        class="inline-flex items-center gap-2 bg-white/20 text-white px-6 py-3 rounded-xl font-medium hover:bg-white/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        テーマから探す
                    </a>
                </div>
            </div>
        </section>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection