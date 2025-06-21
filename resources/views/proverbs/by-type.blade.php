{{-- ファイルパス: resources/views/proverbs/by-type.blade.php --}}
@extends('layout')

@section('title', $typeName . '一覧')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.index') }}" class="hover:text-blue-600">ことわざ・四字熟語辞典</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $typeName }}一覧</li>
            </ol>
        </nav>

        <!-- ヘッダー -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">{{ $typeName }}一覧</h1>
            <p class="text-gray-600">
                @if($type === 'ことわざ')
                    昔から伝わる教訓や知恵を含んだ短い言葉
                @elseif($type === '四字熟語')
                    漢字四文字で構成される慣用句
                @else
                    習慣的に使われる決まった表現
                @endif
            </p>
            <div class="mt-4">
                <span class="bg-{{ $type === 'ことわざ' ? 'red' : ($type === '四字熟語' ? 'green' : 'purple') }}-100 
                            text-{{ $type === 'ことわざ' ? 'red' : ($type === '四字熟語' ? 'green' : 'purple') }}-800 
                            px-4 py-2 rounded-full font-semibold">
                    {{ $proverbs->total() }}件の{{ $typeName }}
                </span>
            </div>
        </div>

        <!-- 種類切り替えナビ -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow p-2 flex space-x-2">
                <a href="{{ route('proverbs.by-type', 'ことわざ') }}" 
                   class="px-4 py-2 rounded {{ $type === 'ことわざ' ? 'bg-red-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    ことわざ
                </a>
                <a href="{{ route('proverbs.by-type', '四字熟語') }}" 
                   class="px-4 py-2 rounded {{ $type === '四字熟語' ? 'bg-green-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    四字熟語
                </a>
                <a href="{{ route('proverbs.by-type', '慣用句') }}" 
                   class="px-4 py-2 rounded {{ $type === '慣用句' ? 'bg-purple-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    慣用句
                </a>
            </div>
        </div>

        <!-- 検索ボックス -->
        <div class="bg-gray-100 rounded-lg p-4 mb-8">
            <form action="{{ route('proverbs.search') }}" method="GET" class="flex gap-4">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="text" name="q" placeholder="{{ $typeName }}を検索..."
                       class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    検索
                </button>
            </form>
        </div>

        <!-- ことわざ・四字熟語一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($proverbs as $proverb)
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                    <div class="mb-3">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600">読み: {{ $proverb->reading }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ Str::limit($proverb->meaning, 150) }}</p>
                    </div>

                    @if($proverb->category)
                        <div class="mb-3">
                            <a href="{{ route('proverb-categories.show', $proverb->category->id) }}" 
                               class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 transition">
                                {{ $proverb->category->name }}
                            </a>
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $proverb->access_count }}回閲覧</span>
                        <a href="{{ route('proverbs.show', $proverb->id) }}" 
                           class="bg-{{ $type === 'ことわざ' ? 'red' : ($type === '四字熟語' ? 'green' : 'purple') }}-600 
                                  text-white px-4 py-2 rounded hover:bg-{{ $type === 'ことわざ' ? 'red' : ($type === '四字熟語' ? 'green' : 'purple') }}-700 
                                  transition text-sm font-semibold">
                            詳細を見る
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mb-8">
            {{ $proverbs->links() }}
        </div>

        <!-- 戻るボタン -->
        <div class="text-center">
            <a href="{{ route('proverbs.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← ことわざ・四字熟語辞典トップに戻る
            </a>
        </div>
    </div>
@endsection