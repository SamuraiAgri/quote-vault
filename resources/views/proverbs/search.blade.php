{{-- ファイルパス: resources/views/proverbs/search.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語検索')

@section('content')
    <div class="container mx-auto px-4">
        <!-- 検索フォーム -->
        <div class="bg-gray-100 p-6 rounded-lg mb-8">
            <h1 class="text-3xl font-semibold mb-4">ことわざ・四字熟語検索</h1>
            <form action="{{ route('proverbs.search') }}" method="GET" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="q" value="{{ $keyword }}" placeholder="ことわざ、意味、読みを入力"
                        class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select name="type" class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">すべての種類</option>
                        <option value="ことわざ" {{ $type === 'ことわざ' ? 'selected' : '' }}>ことわざ</option>
                        <option value="四字熟語" {{ $type === '四字熟語' ? 'selected' : '' }}>四字熟語</option>
                        <option value="慣用句" {{ $type === '慣用句' ? 'selected' : '' }}>慣用句</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                        検索
                    </button>
                </div>
            </form>
        </div>

        <!-- 検索結果 -->
        @if (is_null($results))
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <p class="text-gray-700 text-lg">検索キーワードを入力してください。</p>
                <p class="text-gray-500 text-sm mt-2">ことわざ、四字熟語、慣用句を検索できます</p>
            </div>
        @elseif ($results->isEmpty())
            <div class="text-center py-12">
                <div class="text-6xl mb-4">😅</div>
                <p class="text-gray-700 text-lg">「{{ $keyword }}」に一致するものは見つかりませんでした。</p>
                <p class="text-gray-500 text-sm mt-2">別のキーワードで検索してみてください</p>
            </div>
        @else
            <div class="mb-6">
                <p class="text-gray-700">
                    「{{ $keyword }}」の検索結果: <span class="font-bold">{{ $results->total() }}件</span>
                    @if($type)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm ml-2">{{ $type }}のみ</span>
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($results as $proverb)
                    <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-800">{{ $proverb->word }}</h3>
                            <span class="bg-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-100 
                                        text-{{ $proverb->type === 'ことわざ' ? 'red' : ($proverb->type === '四字熟語' ? 'green' : 'purple') }}-800 
                                        px-2 py-1 rounded text-xs font-semibold">
                                {{ $proverb->type }}
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-2">読み: {{ $proverb->reading }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 120) }}</p>
                        
                        @if($proverb->category)
                            <p class="text-xs text-gray-500 mb-3">
                                カテゴリ: <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" 
                                           class="text-blue-600 hover:text-blue-800">{{ $proverb->category->name }}</a>
                            </p>
                        @endif
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $proverb->access_count }}回閲覧</span>
                            <a href="{{ route('proverbs.show', $proverb->id) }}" 
                               class="text-blue-600 hover:text-blue-800 font-semibold text-sm">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mt-8">
                {{ $results->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- 人気のことわざ・四字熟語 -->
        <section class="mt-12 mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気のことわざ・四字熟語</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $popularItems = App\Models\Proverb::popular()->limit(12)->get();
                @endphp
                @foreach($popularItems as $item)
                    <a href="{{ route('proverbs.show', $item->id) }}" 
                       class="bg-white hover:bg-gray-50 shadow rounded-lg p-3 text-center transition">
                        <div class="font-bold text-sm text-gray-800 mb-1">{{ $item->word }}</div>
                        <div class="text-xs text-gray-500">{{ $item->type }}</div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection