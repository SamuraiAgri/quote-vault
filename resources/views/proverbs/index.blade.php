{{-- resources/views/proverbs/index.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語・慣用句')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => 'ことわざ・四字熟語']
        ]])

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">ことわざ・四字熟語・慣用句</h1>
            <p class="text-gray-600">日本の伝統的なことわざ、四字熟語、慣用句を探すことができます。</p>
        </div>

        <!-- 検索・種類別リンク -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <a href="{{ route('proverbs.search') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">検索</span>
            </a>
            <a href="{{ route('proverbs.popular') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">人気ランキング</span>
            </a>
            <a href="{{ route('proverb-categories.index') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">カテゴリ一覧</span>
            </a>
        </div>

        <!-- 種類別リンク -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">種類別</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('proverbs.by-type', 'ことわざ') }}" class="bg-green-100 hover:bg-green-200 transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-green-800">ことわざ</span>
                </a>
                <a href="{{ route('proverbs.by-type', '四字熟語') }}" class="bg-purple-100 hover:bg-purple-200 transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-purple-800">四字熟語</span>
                </a>
                <a href="{{ route('proverbs.by-type', '慣用句') }}" class="bg-orange-100 hover:bg-orange-200 transition rounded-lg p-4 text-center shadow">
                    <span class="text-lg font-bold text-orange-800">慣用句</span>
                </a>
            </div>
        </section>

        <!-- カテゴリ一覧 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">カテゴリ一覧</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('proverb-categories.show', $category->id) }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                        <span class="text-lg font-bold text-blue-800">{{ $category->name }}</span>
                        <p class="text-sm text-gray-600 mt-2">{{ $category->proverbs_count }}件</p>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 人気のことわざ・四字熟語 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気のことわざ・四字熟語</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularProverbs as $proverb)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $proverb->reading }}</p>
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 60) }}</p>
                        <p class="text-xs text-gray-600 mb-4">アクセス数: {{ $proverb->access_count }}</p>
                        <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 最近アクセスされたことわざ・四字熟語 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">最近アクセスされたことわざ・四字熟語</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentProverbs as $proverb)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $proverb->word }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $proverb->reading }}</p>
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $proverb->type }}</span>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($proverb->meaning, 60) }}</p>
                        <a href="{{ route('proverbs.show', $proverb->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-4 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection