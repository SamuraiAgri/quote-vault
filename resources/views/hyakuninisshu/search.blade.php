{{-- resources/views/hyakuninisshu/search.blade.php --}}
@extends('layout')

@section('title', '百人一首検索')

@section('content')
    <div class="container mx-auto px-4">
        <!-- 検索フォーム -->
        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4">百人一首検索</h1>
            <form action="{{ route('hyakuninisshu.search') }}" method="GET" class="space-y-4">
                <!-- キーワード検索 -->
                <div>
                    <label for="q" class="block text-sm font-medium text-gray-700 mb-2">キーワード</label>
                    <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="歌詞、読み、現代語訳から検索"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- フィルター -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 季節 -->
                    <div>
                        <label for="season" class="block text-sm font-medium text-gray-700 mb-2">季節</label>
                        <select name="season" id="season" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">すべて</option>
                            @foreach(['春', '夏', '秋', '冬'] as $seasonOption)
                                <option value="{{ $seasonOption }}" {{ request('season') === $seasonOption ? 'selected' : '' }}>
                                    {{ $seasonOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- テーマ -->
                    <div>
                        <label for="theme" class="block text-sm font-medium text-gray-700 mb-2">テーマ</label>
                        <select name="theme" id="theme" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">すべて</option>
                            @foreach(['恋', '自然', '人生', '別れ', '思慕'] as $themeOption)
                                <option value="{{ $themeOption }}" {{ request('theme') === $themeOption ? 'selected' : '' }}>
                                    {{ $themeOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 歌人 -->
                    <div>
                        <label for="poet_id" class="block text-sm font-medium text-gray-700 mb-2">歌人</label>
                        <select name="poet_id" id="poet_id" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">すべて</option>
                            @foreach($poets as $poet)
                                <option value="{{ $poet->id }}" {{ request('poet_id') == $poet->id ? 'selected' : '' }}>
                                    {{ $poet->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    検索
                </button>
            </form>
        </div>

        <!-- 検索結果 -->
        @if (is_null($results))
            <p class="text-gray-700 text-center">検索条件を入力してください。</p>
        @elseif ($results->isEmpty())
            <p class="text-gray-700 text-center">検索条件に一致する歌は見つかりませんでした。</p>
        @else
            <p class="text-gray-700 mb-4">検索結果: {{ $results->total() }}件</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($results as $poem)
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                        <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                        <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                        <p class="text-sm text-gray-600 mb-2">歌人: 
                            <a href="{{ route('poets.show', $poem->poet->id) }}" class="text-blue-500">
                                {{ $poem->poet->name }}
                            </a>
                        </p>
                        @if($poem->season)
                            <p class="text-sm text-gray-600 mb-2">季節: {{ $poem->season }}</p>
                        @endif
                        @if($poem->theme)
                            <p class="text-sm text-gray-600 mb-4">テーマ: {{ $poem->theme }}</p>
                        @endif
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>

        @endif
    </div>
@endsection