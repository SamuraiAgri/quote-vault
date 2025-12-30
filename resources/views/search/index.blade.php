@extends('layouts.app')

@section('title', $keyword ? '「' . $keyword . '」の検索結果' : '検索')

@section('meta_description', $keyword ? '「' . $keyword . '」の検索結果一覧。名言・格言、ことわざ・四字熟語、百人一首から検索できます。' : '名言・格言、ことわざ・四字熟語、百人一首を横断的に検索できます。')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '検索']
        ]])

        {{-- 検索フォーム --}}
        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4">検索</h1>
            <form action="{{ route('search.index') }}" method="GET" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="q" value="{{ $keyword ?? '' }}" placeholder="キーワードを入力"
                        class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="検索キーワード">
                    <select name="type" class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ ($type ?? 'all') === 'all' ? 'selected' : '' }}>すべて</option>
                        <option value="quotes" {{ ($type ?? '') === 'quotes' ? 'selected' : '' }}>名言・格言</option>
                        <option value="proverbs" {{ ($type ?? '') === 'proverbs' ? 'selected' : '' }}>ことわざ・四字熟語</option>
                        <option value="poems" {{ ($type ?? '') === 'poems' ? 'selected' : '' }}>百人一首</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        検索
                    </button>
                </div>
            </form>
        </div>

        {{-- 検索結果 --}}
        @if (is_null($results))
            <p class="text-gray-700 text-center py-8">検索キーワードを入力してください。</p>
        @elseif (is_array($results))
            {{-- 全検索の場合（タイプ別表示） --}}
            @php
                $totalCount = ($results['quotes']->total() ?? 0) + ($results['proverbs']->total() ?? 0) + ($results['poems']->total() ?? 0);
            @endphp
            
            @if ($totalCount === 0)
                <p class="text-gray-700 text-center py-8">「{{ $keyword }}」に一致する結果は見つかりませんでした。</p>
            @else
                <p class="text-gray-700 mb-6">「{{ $keyword }}」の検索結果: 合計{{ $totalCount }}件</p>

                {{-- 名言・格言 --}}
                @if ($results['quotes']->count() > 0)
                <section class="mb-10">
                    <h2 class="text-2xl font-semibold mb-4 text-blue-800">📜 名言・格言（{{ $results['quotes']->total() }}件）</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($results['quotes'] as $quote)
                            <div class="bg-white shadow rounded-lg p-6">
                                <blockquote class="text-lg text-gray-800 italic mb-4 line-clamp-3">"{{ $quote->quote_text }}"</blockquote>
                                <p class="text-sm text-gray-600">著者: 
                                    <a href="{{ route('authors.show', $quote->author->id) }}" class="text-blue-600 hover:underline">
                                        {{ $quote->author->name }}
                                    </a>
                                </p>
                                <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 mt-4 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if ($results['quotes']->hasPages())
                        @include('components.pagination', ['paginator' => $results['quotes']])
                    @endif
                </section>
                @endif

                {{-- ことわざ・四字熟語 --}}
                @if ($results['proverbs']->count() > 0)
                <section class="mb-10">
                    <h2 class="text-2xl font-semibold mb-4 text-green-800">🌿 ことわざ・四字熟語（{{ $results['proverbs']->total() }}件）</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($results['proverbs'] as $proverb)
                            <div class="bg-white shadow rounded-lg p-6">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $proverb->reading }}</p>
                                <p class="text-sm text-gray-700 mb-4 line-clamp-2">{{ Str::limit($proverb->meaning, 60) }}</p>
                                <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-green-600 border-2 border-green-600 hover:bg-green-600 hover:text-white rounded px-4 py-2 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if ($results['proverbs']->hasPages())
                        @include('components.pagination', ['paginator' => $results['proverbs']])
                    @endif
                </section>
                @endif

                {{-- 百人一首 --}}
                @if ($results['poems']->count() > 0)
                <section class="mb-10">
                    <h2 class="text-2xl font-semibold mb-4 text-purple-800">🎋 百人一首（{{ $results['poems']->total() }}件）</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($results['poems'] as $poem)
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="text-purple-600 font-bold text-sm mb-2">第{{ $poem->number }}番</div>
                                <p class="text-gray-800 mb-1">{{ $poem->upper_phrase }}</p>
                                <p class="text-gray-800 mb-4">{{ $poem->lower_phrase }}</p>
                                <p class="text-sm text-gray-600 mb-4">歌人: {{ $poem->poet->name ?? '不明' }}</p>
                                <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-purple-600 border-2 border-purple-600 hover:bg-purple-600 hover:text-white rounded px-4 py-2 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if ($results['poems']->hasPages())
                        @include('components.pagination', ['paginator' => $results['poems']])
                    @endif
                </section>
                @endif
            @endif
        @else
            {{-- 単一タイプ検索の場合 --}}
            @if ($results->isEmpty())
                <p class="text-gray-700 text-center py-8">「{{ $keyword }}」に一致する結果は見つかりませんでした。</p>
            @else
                <p class="text-gray-700 mb-6">「{{ $keyword }}」の検索結果: {{ $results->total() }}件</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($results as $item)
                        @if ($type === 'quotes')
                            <div class="bg-white shadow rounded-lg p-6">
                                <blockquote class="text-lg text-gray-800 italic mb-4 line-clamp-3">"{{ $item->quote_text }}"</blockquote>
                                <p class="text-sm text-gray-600">著者: 
                                    <a href="{{ route('authors.show', $item->author->id) }}" class="text-blue-600 hover:underline">
                                        {{ $item->author->name }}
                                    </a>
                                </p>
                                <a href="{{ route('quotes.show', $item->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 mt-4 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @elseif ($type === 'proverbs')
                            <div class="bg-white shadow rounded-lg p-6">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded mb-2">{{ $item->type }}</span>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $item->word }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $item->reading }}</p>
                                <p class="text-sm text-gray-700 mb-4 line-clamp-2">{{ Str::limit($item->meaning, 60) }}</p>
                                <a href="{{ route('proverbs.show', $item->id) }}" class="inline-block text-green-600 border-2 border-green-600 hover:bg-green-600 hover:text-white rounded px-4 py-2 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @elseif ($type === 'poems')
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="text-purple-600 font-bold text-sm mb-2">第{{ $item->number }}番</div>
                                <p class="text-gray-800 mb-1">{{ $item->upper_phrase }}</p>
                                <p class="text-gray-800 mb-4">{{ $item->lower_phrase }}</p>
                                <p class="text-sm text-gray-600 mb-4">歌人: {{ $item->poet->name ?? '不明' }}</p>
                                <a href="{{ route('hyakuninisshu.show', $item->id) }}" class="inline-block text-purple-600 border-2 border-purple-600 hover:bg-purple-600 hover:text-white rounded px-4 py-2 transition">
                                    詳細を見る
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                {{-- ページネーション --}}
                @include('components.pagination', ['paginator' => $results])
            @endif
        @endif
    </div>
@endsection
