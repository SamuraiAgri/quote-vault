{{-- resources/views/quotes/show-new.blade.php --}}
{{-- リニューアルされた名言詳細ページ - 回遊性強化版 --}}
@extends('layouts.app')

@section('title', $quote->author->name . 'の名言「' . Str::limit($quote->quote_text, 30) . '」| Quote Vault')

@section('meta_description', Str::limit($quote->quote_text, 150) . ' - ' . $quote->author->name . 'の名言・格言。カテゴリ: ' . $quote->category->name)

@section('meta_keywords', $quote->author->name . ',名言,格言,' . $quote->category->name . ',偉人の言葉')

@section('og_type', 'article')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Quotation",
    "text": "{{ $quote->quote_text }}",
    "spokenByCharacter": {
        "@type": "Person",
        "name": "{{ $quote->author->name }}"
    },
    "author": {
        "@type": "Person",
        "name": "{{ $quote->author->name }}"
    },
    "about": {
        "@type": "Thing",
        "name": "{{ $quote->category->name }}"
    },
    "inLanguage": "ja",
    "datePublished": "{{ $quote->created_at->toIso8601String() }}",
    "url": "{{ route('quotes.show', $quote->id) }}"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "ホーム",
            "item": "{{ route('home') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "名言・格言",
            "item": "{{ route('largecategories.index') }}"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $quote->category->largeCategory->name ?? 'カテゴリ' }}",
            "item": "{{ route('largecategories.show', $quote->category->largeCategory->id ?? 1) }}"
        },
        {
            "@type": "ListItem",
            "position": 4,
            "name": "{{ $quote->category->name }}",
            "item": "{{ route('categories.show', $quote->category->id) }}"
        },
        {
            "@type": "ListItem",
            "position": 5,
            "name": "{{ Str::limit($quote->quote_text, 30) }}"
        }
    ]
}
</script>
@endsection

@section('content')
<div class="space-y-8">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => $quote->category->largeCategory->name ?? 'カテゴリ', 'url' => route('largecategories.show', $quote->category->largeCategory->id ?? 1)],
        ['name' => $quote->category->name, 'url' => route('categories.show', $quote->category->id)],
        ['name' => Str::limit($quote->quote_text, 20)]
    ]])

    {{-- 名言メインカード --}}
    <article class="bg-white rounded-3xl shadow-xl overflow-hidden">
        {{-- グラデーションヘッダー --}}
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 md:p-12 text-white">
            <div class="max-w-3xl mx-auto text-center">
                {{-- 引用符装飾 --}}
                <svg class="w-12 h-12 mx-auto mb-6 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                
                {{-- 名言本文 --}}
                <blockquote class="text-2xl md:text-3xl lg:text-4xl font-medium leading-relaxed mb-8">
                    {{ $quote->quote_text }}
                </blockquote>
                
                {{-- 著者 --}}
                <div class="flex items-center justify-center gap-4">
                    <a href="{{ route('authors.show', $quote->author->id) }}" class="flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-5 py-2 hover:bg-white/30 transition-all">
                        <div class="w-10 h-10 bg-white/30 rounded-full flex items-center justify-center font-bold">
                            {{ mb_substr($quote->author->name, 0, 1) }}
                        </div>
                        <span class="font-medium">{{ $quote->author->name }}</span>
                    </a>
                </div>
            </div>
        </div>
        
        {{-- アクション・情報エリア --}}
        <div class="p-6 md:p-8">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                {{-- カテゴリ・統計 --}}
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('categories.show', $quote->category->id) }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        {{ $quote->category->name }}
                    </a>
                    <span class="flex items-center gap-1 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($quote->access_count) }}回閲覧
                    </span>
                </div>
                
                {{-- SNS共有ボタン --}}
                @include('components.share-buttons', [
                    'title' => $quote->quote_text . ' - ' . $quote->author->name,
                    'url' => url()->current()
                ])
            </div>
        </div>
    </article>

    {{-- 広告（読書体験を壊さない位置） --}}
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

    {{-- 回遊性強化セクション --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- 左側: 関連名言と著者の他の名言 --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- 同じカテゴリの名言 --}}
            @if($relatedQuotes->count() > 0)
            <section>
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </span>
                    「{{ $quote->category->name }}」の他の名言
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($relatedQuotes as $related)
                    <a href="{{ route('quotes.show', $related->id) }}" class="group bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all border border-gray-100 hover:border-indigo-200">
                        <blockquote class="text-gray-800 leading-relaxed mb-3 line-clamp-3">
                            "{{ $related->quote_text }}"
                        </blockquote>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">— {{ $related->author->name }}</span>
                            <span class="text-indigo-600 text-sm font-medium group-hover:underline">読む →</span>
                        </div>
                    </a>
                    @endforeach
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('categories.show', $quote->category->id) }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
                        「{{ $quote->category->name }}」の名言をもっと見る
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </section>
            @endif

            {{-- 同じ著者の名言 --}}
            @php
            $authorQuotes = \App\Models\Quote::where('author_id', $quote->author_id)
                ->where('id', '!=', $quote->id)
                ->with('category')
                ->limit(4)
                ->get();
            @endphp
            
            @if($authorQuotes->count() > 0)
            <section>
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    {{ $quote->author->name }}の他の名言
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($authorQuotes as $authorQuote)
                    <a href="{{ route('quotes.show', $authorQuote->id) }}" class="group bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all border border-gray-100 hover:border-blue-200">
                        <span class="inline-block px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded mb-2">{{ $authorQuote->category->name }}</span>
                        <blockquote class="text-gray-800 leading-relaxed line-clamp-3">
                            "{{ $authorQuote->quote_text }}"
                        </blockquote>
                    </a>
                    @endforeach
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('authors.show', $quote->author->id) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
                        {{ $quote->author->name }}の名言をすべて見る
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </section>
            @endif
        </div>

        {{-- 右側: サイドバー --}}
        <aside class="space-y-6">
            {{-- 著者プロフィール --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4">著者について</h3>
                <a href="{{ route('authors.show', $quote->author->id) }}" class="flex items-center gap-4 mb-4 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
                        {{ mb_substr($quote->author->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $quote->author->name }}</h4>
                        @php
                        $authorQuoteCount = $quote->author->quotes()->count();
                        @endphp
                        <p class="text-sm text-gray-500">{{ $authorQuoteCount }}件の名言</p>
                    </div>
                </a>
                <a href="{{ route('authors.show', $quote->author->id) }}" class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl transition-colors">
                    この著者の名言を見る
                </a>
            </div>

            {{-- ランダム名言 --}}
            <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl p-6 text-white">
                <h3 class="font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    ランダムで探す
                </h3>
                <p class="text-purple-100 text-sm mb-4">偶然の出会いで新しい名言を発見しましょう</p>
                <a href="{{ route('random.quote') }}" class="w-full inline-flex items-center justify-center gap-2 bg-white text-purple-600 px-4 py-2.5 rounded-xl font-medium hover:bg-purple-50 transition-colors">
                    ランダム名言
                </a>
            </div>

            {{-- 関連テーマ --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4">関連テーマ</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Models\Category::where('largecategory_id', $quote->category->largecategory_id)->where('id', '!=', $quote->category_id)->take(6)->get() as $relatedCat)
                    <a href="{{ route('categories.show', $relatedCat->id) }}" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-indigo-100 text-gray-700 hover:text-indigo-700 rounded-lg text-sm transition-colors">
                        {{ $relatedCat->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- 他のコンテンツへの誘導 --}}
            <div class="bg-gray-50 rounded-2xl p-6">
                <h3 class="font-bold text-gray-800 mb-4">他のコンテンツ</h3>
                <div class="space-y-3">
                    <a href="{{ route('proverbs.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-green-600 transition-colors">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="font-medium">ことわざ・四字熟語</span>
                    </a>
                    <a href="{{ route('hyakuninisshu.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-purple-600 transition-colors">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <span class="font-medium">百人一首</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
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
