{{-- resources/views/proverbs/search.blade.php --}}
@extends('layouts.app')

@section('title', 'ことわざ・四字熟語検索')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => 'ことわざ・四字熟語', 'url' => route('proverbs.index')],
            ['name' => '検索']
        ]])

        <!-- 検索フォーム -->
        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4">ことわざ・四字熟語検索</h1>
            <form action="{{ route('proverbs.search') }}" method="GET" class="space-y-4">
                <!-- キーワード検索 -->
                <div>
                    <label for="q" class="block text-sm font-medium text-gray-700 mb-2">キーワード</label>
                    <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="語句、読み、意味から検索"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- 種類フィルター -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">種類</label>
                    <select name="type" id="type" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">すべて</option>
                        @foreach(['ことわざ', '四字熟語', '慣用句'] as $typeOption)
                            <option value="{{ $typeOption }}" {{ request('type') === $typeOption ? 'selected' : '' }}>
                                {{ $typeOption }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    検索
                </button>
            </form>
        </div>

        <!-- 検索結果 -->
        @if (is_null($results))
            <p class="text-gray-700 text-center">検索キーワードを入力してください。</p>
        @elseif ($results->isEmpty())
            <p class="text-gray-700 text-center">「{{ $keyword }}」に一致するものは見つかりませんでした。</p>
        @else
            <p class="text-gray-700 mb-4">「{{ $keyword }}」の検索結果: {{ $results->total() }}件</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($results as $proverb)
                    <div class="bg-white shadow rounded-lg p-6">
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $proverb->reading }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 80) }}</p>
                        
                        @if($proverb->category)
                            <p class="text-xs text-gray-600 mb-4">
                                カテゴリ: 
                                <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" class="text-blue-500">
                                    {{ $proverb->category->name }}
                                </a>
                            </p>
                        @endif
                        
                        <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @endif
    </div>
@endsection