{{-- resources/views/hyakuninisshu/index.blade.php --}}
@extends('layout')

@section('title', '百人一首')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '百人一首']
        ]])

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">百人一首</h1>
            <p class="text-gray-600">百人一首の歌を番号順、季節別、テーマ別で探すことができます。</p>
        </div>

        <!-- 検索・フィルターリンク -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <a href="{{ route('hyakuninisshu.search') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">歌を検索</span>
            </a>
            <a href="{{ route('hyakuninisshu.popular') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">人気の歌</span>
            </a>
            <a href="{{ route('poets.index') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow">
                <span class="text-lg font-bold text-blue-800">歌人一覧</span>
            </a>
        </div>

        <!-- 季節別リンク -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">季節別</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($seasons as $season)
                    <a href="{{ route('hyakuninisshu.by-season', $season) }}" class="bg-green-100 hover:bg-green-200 transition rounded-lg p-4 text-center shadow">
                        <span class="text-lg font-bold text-green-800">{{ $season }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- テーマ別リンク -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">テーマ別</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($themes as $theme)
                    <a href="{{ route('hyakuninisshu.by-theme', $theme) }}" class="bg-purple-100 hover:bg-purple-200 transition rounded-lg p-4 text-center shadow">
                        <span class="text-lg font-bold text-purple-800">{{ $theme }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 人気の歌 -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">人気の歌</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularPoems as $poem)
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                        <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                        <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                        <p class="text-sm text-gray-600 mb-2">歌人: {{ $poem->poet->name }}</p>
                        <p class="text-sm text-gray-600 mb-4">アクセス数: {{ $poem->access_count }}</p>
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 歌一覧 -->
        <section>
            <h2 class="text-2xl font-semibold mb-4">歌一覧</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($poems as $poem)
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                        <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                        <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                        <p class="text-sm text-gray-600 mb-2">歌人: {{ $poem->poet->name }}</p>
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

        </section>
    </div>
@endsection