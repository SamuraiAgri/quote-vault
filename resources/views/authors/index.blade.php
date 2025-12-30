{{-- resources/views/authors/index-new.blade.php --}}
{{-- リニューアルされた著者一覧ページ --}}
@extends('layouts.app')

@section('title', '偉人・著者一覧 | 名言・格言サイト Quote Vault')

@section('meta_description', '名言・格言を残した偉人・著者を50音順で一覧表示。哲学者、作家、政治家、科学者など1000人以上の人物から名言を探せます。アリストテレス、孔子、夏目漱石など。')

@section('meta_keywords', '偉人,著者,一覧,名言,格言,哲学者,作家,政治家,科学者,50音順,検索')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "偉人・著者一覧",
    "description": "名言・格言を残した偉人・著者を50音順で掲載",
    "url": "{{ route('authors.index') }}",
    "breadcrumb": {
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
                "name": "偉人・著者一覧"
            }
        ]
    }
}
</script>
@endsection

@section('content')
<div class="space-y-8">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => '偉人・著者一覧']
    ]])

    {{-- ページヘッダー --}}
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 md:p-12 text-white">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">偉人・著者一覧</h1>
        <p class="text-blue-100 max-w-2xl">
            歴史に名を残す偉人たちの名言・格言を探しましょう。50音順で整理されているので、お目当ての人物をすぐに見つけられます。
        </p>
        
        {{-- 検索フォーム --}}
        <div class="mt-6 max-w-lg">
            <form action="{{ route('search.index') }}" method="GET" class="relative">
                <input 
                    type="search" 
                    name="query" 
                    placeholder="偉人の名前で検索..."
                    class="w-full px-5 py-3 pl-12 rounded-xl bg-white/20 backdrop-blur-sm text-white placeholder-blue-200 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 focus:bg-white/30"
                >
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </form>
        </div>
    </div>

    {{-- 50音クイックナビ --}}
    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-20 z-30">
        <p class="text-sm text-gray-500 mb-3">クイックジャンプ：</p>
        <div class="flex flex-wrap gap-2">
            @foreach ($groupedAuthors as $initial => $group)
            <a 
                href="#kana-{{ $initial }}" 
                class="w-10 h-10 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold flex items-center justify-center transition-colors"
            >
                {{ $initial }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- 著者リスト --}}
    <div class="space-y-12">
        @foreach ($groupedAuthors as $initial => $group)
        <section id="kana-{{ $initial }}" class="scroll-mt-40">
            {{-- セクションヘッダー --}}
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-blue-500/30">
                    {{ $initial }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">「{{ $initial }}」で始まる偉人</h2>
                    <p class="text-gray-500 text-sm">{{ $group->count() }}人</p>
                </div>
            </div>
            
            {{-- 著者カード --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($group as $author)
                <a 
                    href="{{ route('authors.show', $author->id) }}" 
                    class="group bg-white hover:bg-blue-50 rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-blue-200"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-gray-200 to-gray-300 group-hover:from-blue-100 group-hover:to-blue-200 rounded-full flex items-center justify-center text-lg font-bold text-gray-600 group-hover:text-blue-700 transition-colors flex-shrink-0">
                            {{ mb_substr($author->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-gray-800 group-hover:text-blue-700 transition-colors truncate">
                                {{ $author->name }}
                            </h3>
                            <p class="text-xs text-gray-400">
                                {{ $author->quotes_count ?? $author->quotes->count() }}件の名言
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>

    {{-- ページ下部のCTA --}}
    <section class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-3xl p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">お探しの偉人が見つからない場合</h2>
        <p class="text-gray-600 mb-6">キーワード検索でより詳しく探すことができます</p>
        <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            詳細検索へ
        </a>
    </section>
</div>
@endsection
