@extends('layout')

@section('title', $quote->author->name . 'の名言 | 名言・格言サイト')

@section('meta_description', Str::limit($quote->quote_text, 150) . ' - ' . $quote->author->name . 'の名言・格言。カテゴリ: ' . $quote->category->name)

@section('meta_keywords', $quote->author->name . ',名言,格言,' . $quote->category->name . ',偉人の言葉')

@section('og_type', 'article')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Quotation",
    "text": "{{ $quote->quote_text }}",
    "author": {
        "@type": "Person",
        "name": "{{ $quote->author->name }}"
    },
    "about": {
        "@type": "Thing",
        "name": "{{ $quote->category->name }}"
    }
}
</script>
@endsection

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '名言・格言', 'url' => route('largecategories.index')],
            ['name' => $quote->category->largeCategory->name ?? 'カテゴリ', 'url' => route('largecategories.show', $quote->category->largeCategory->id ?? 1)],
            ['name' => $quote->category->name, 'url' => route('categories.show', $quote->category->id)],
            ['name' => $quote->author->name . 'の名言']
        ]])

        {{-- 名言メインカード --}}
        <article class="bg-white shadow-lg rounded-lg p-8 mb-8">
            <header class="text-center mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-800 mb-4">{{ $quote->author->name }}の名言</h1>
            </header>
            
            <blockquote class="text-xl md:text-2xl text-gray-800 italic text-center py-6 border-l-4 border-blue-500 pl-6 bg-blue-50 rounded-r-lg">
                "{{ $quote->quote_text }}"
            </blockquote>

            {{-- SNS共有ボタン --}}
            <div class="mt-6 pt-4 border-t border-gray-200">
                @include('components.share-buttons', [
                    'title' => $quote->quote_text . ' - ' . $quote->author->name,
                    'url' => url()->current()
                ])
            </div>
        </article>

        {{-- 詳細情報 --}}
        <aside class="bg-gray-50 shadow rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">詳細情報</h2>
            <dl class="space-y-3">
                <div class="flex flex-wrap">
                    <dt class="text-gray-600 w-24">著者:</dt>
                    <dd>
                        <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $quote->author->name }}
                        </a>
                    </dd>
                </div>
                <div class="flex flex-wrap">
                    <dt class="text-gray-600 w-24">カテゴリ:</dt>
                    <dd>
                        <a href="{{ route('categories.show', $quote->category->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $quote->category->name }}
                        </a>
                    </dd>
                </div>
                <div class="flex flex-wrap">
                    <dt class="text-gray-600 w-24">閲覧数:</dt>
                    <dd class="text-gray-800">{{ number_format($quote->access_count) }} 回</dd>
                </div>
            </dl>
        </aside>

        {{-- 関連する名言 --}}
        @if($relatedQuotes->count() > 0)
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">関連する名言</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($relatedQuotes as $related)
                    @include('components.related-card', ['item' => $related, 'type' => 'quote'])
                @endforeach
            </div>
        </section>
        @endif

        {{-- 同じ著者の他の名言へのリンク --}}
        <div class="text-center mt-8">
            <a href="{{ route('authors.show', $quote->author->id) }}" 
               class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                {{ $quote->author->name }}の他の名言を見る
            </a>
        </div>
    </div>
@endsection
