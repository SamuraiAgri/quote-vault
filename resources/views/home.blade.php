@extends('layout')

@section('title', 'ホーム')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-4">偉人の名言・格言サイト</h1>
        <p class="text-gray-600">このサイトでは、偉人の名言や格言をカテゴリ別、著者別、キーワード検索で探すことができます。</p>
    </div>

    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">人気の名言</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularQuotes as $quote)
                <div class="bg-white shadow rounded p-6">
                    <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                    <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                    <a href="{{ route('quotes.show', $quote->id) }}" class="text-blue-500 underline mt-2 block">詳細を見る</a>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold mb-4">大カテゴリ一覧</h2>
        <div class="flex flex-wrap gap-4">
            @foreach($largeCategories as $largeCategory)
                <div class="bg-blue-100 rounded p-4 text-center w-full sm:w-1/2 md:w-1/3">
                    <a href="{{ route('largecategories.show', $largeCategory->id) }}" class="text-blue-700 font-semibold">
                        {{ $largeCategory->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
