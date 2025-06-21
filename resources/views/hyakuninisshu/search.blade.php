{{-- resources/views/hyakuninisshu/search.blade.php --}}
@extends('layout')

@section('title', '百人一首検索')

@section('content')
    <div class="container mx-auto px-4">
        <!-- 検索フォーム -->
        <div class="bg-gradient-to-r from-purple-100 to-pink-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4 text-purple-800">百人一首検索</h1>
            <form action="{{ route('hyakuninisshu.search') }}" method="GET" class="space-y-4">
                <!-- キーワード検索 -->
                <div>
                    <label class="block text-sm font-semibold text-purple-700 mb-2">キーワード検索</label>
                    <input type="text" name="q" value="{{ $keyword }}" placeholder="歌の内容、現代語訳を検索..."
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <!-- フィルター -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 季節 -->
                    <div>
                        <label class="block text-sm font-semibold text-purple-700 mb-2">季節</label>
                        <select name="season" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">すべての季節</option>
                            <option value="春" {{ $season === '春' ? 'selected' : '' }}>春</option>
                            <option value="夏" {{ $season === '夏' ? 'selected' : '' }}>夏</option>
                            <option value="秋" {{ $season === '秋' ? 'selected' : '' }}>秋</option>
                            <option value="冬" {{ $season === '冬' ? 'selected' : '' }}>冬</option>
                        </select>
                    </div>

                    <!-- テーマ -->
                    <div>
                        <label class="block text-sm font-semibold text-purple-700 mb-2">テーマ</label>
                        <select name="theme" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">すべてのテーマ</option>
                            <option value="恋" {{ $theme === '恋' ? 'selected' : '' }}>恋</option>
                            <option value="自然" {{ $theme === '自然' ? 'selected' : '' }}>自然</option>
                            <option value="人生" {{ $theme === '人生' ? 'selected' : '' }}>人生</option>
                            <option value="別れ" {{ $theme === '別れ' ? 'selected' : '' }}>別れ</option>
                            <option value="思慕" {{ $theme === '思慕' ? 'selected' : '' }}>思慕</option>
                        </select>
                    </div>

                    <!-- 歌人 -->
                    <div>
                        <label class="block text-sm font-semibold text-purple-700 mb-2">歌人</label>
                        <select name="poet_id" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">すべての歌人</option>
                            @if(isset($poets))
                                @foreach($poets as $poet)
                                    <option value="{{ $poet->id }}" {{ $poet_id == $poet->id ? 'selected' : '' }}>
                                        {{ $poet->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                        🔍 検索
                    </button>
                </div>
            </form>
        </div>

        <!-- 検索結果 -->
        @if (is_null($results))
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🎋</div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">百人一首を検索</h2>
                <p class="text-gray-600">歌の内容、季節、テーマ、歌人から検索できます</p>
            </div>
        @elseif ($results->isEmpty())
            <div class="text-center py-12">
                <div class="text-6xl mb-4">😔</div>
                <p class="text-gray-700 text-lg">検索条件に一致する歌は見つかりませんでした。</p>
                <p class="text-gray-500 text-sm mt-2">別の条件で検索してみてください</p>
            </div>
        @else
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">検索結果</h2>
                <p class="text-gray-600">
                    <span class="font-bold">{{ $results->total() }}首</span>の歌が見つかりました
                    @if($keyword)
                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm ml-2">「{{ $keyword }}」</span>
                    @endif
                    @if($season)
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm ml-2">{{ $season }}</span>
                    @endif
                    @if($theme)
                        <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded text-sm ml-2">{{ $theme }}</span>
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($results as $poem)
                    <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition">
                        <div class="mb-3">
                            <div class="flex justify-between items-start">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-sm font-semibold">
                                    {{ $poem->number }}番
                                </span>
                                <div class="text-right">
                                    @if($poem->season)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                            {{ $poem->season }}
                                        </span>
                                    @endif
                                    @if($poem->theme)
                                        <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded text-xs ml-1">
                                            {{ $poem->theme }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-lg font-medium text-gray-800 leading-relaxed mb-2 font-serif">
                                {{ $poem->upper_phrase }}<br>
                                {{ $poem->lower_phrase }}
                            </p>
                            <p class="text-sm text-purple-600">
                                <a href="{{ route('poets.show', $poem->poet->id) }}" class="hover:text-purple-800">
                                    {{ $poem->poet->name }}
                                </a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ Str::limit($poem->modern_translation, 100) }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $poem->access_count }}回閲覧</span>
                            <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                               class="text-purple-600 hover:text-purple-800 font-semibold text-sm">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mt-8">
                {{ $results->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- 人気の歌 -->
        <section class="mt-12 mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気の歌</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @php
                    try {
                        $popularPoems = class_exists('App\Models\Hyakuninisshu') ? 
                            App\Models\Hyakuninisshu::popular()->limit(10)->get() : 
                            collect();
                    } catch (\Exception $e) {
                        $popularPoems = collect();
                    }
                @endphp
                @forelse($popularPoems as $poem)
                    <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                       class="bg-white hover:bg-purple-50 shadow rounded-lg p-3 text-center transition border hover:border-purple-300">
                        <div class="font-bold text-purple-600 mb-1">{{ $poem->number }}番</div>
                        <div class="text-xs text-gray-600">{{ $poem->poet->name }}</div>
                        @if($poem->season)
                            <div class="text-xs text-green-600 mt-1">{{ $poem->season }}</div>
                        @endif
                    </a>
                @empty
                    <div class="col-span-5 text-center py-8">
                        <p class="text-gray-500">人気の歌を準備中です</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection