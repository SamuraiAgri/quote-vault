@extends('layout')

@section('title', 'ホーム')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-4">偉人の名言・格言サイト</h1>
        <p class="text-gray-600">このサイトでは、偉人の名言や格言をカテゴリ別、著者別、キーワード検索で探すことができます。</p>
    </div>

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
